<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Carbon;
use App\Models\user;
use Auth;
use Hash;
use Redirect;
use DB;

class MainController extends Controller
{
    function users()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Users',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );

        return view('Users.list')->with($data);
    }

    function inputsurat()
    {
        $idn_user   = idn_user(auth::user()->id);
        if($idn_user->role_id == 7){
            $arr        = DB::table('trx_surat')->select('trx_surat.*', 'b.name as usr_name', 'c.name as usr_role', 'd.name as usr_to_dept')
                ->leftJoin('users AS b', 'b.id', '=', 'trx_surat.employe')
                ->leftJoin('mst_role AS c', 'c.id', '=', 'trx_surat.role_id')
                ->leftJoin('mst_role AS d', 'd.id', '=', 'trx_surat.to_dept')
                ->whereIn('trx_surat.role_id', [6,7])
                ->where('trx_surat.is_active', 1)->orderBy('trx_surat.letter_admin', 'asc')->get();
        }else{
            $arr        = DB::table('trx_surat')->select('trx_surat.*', 'b.name as usr_name', 'c.name as usr_role', 'd.name as usr_to_dept')
                ->leftJoin('users AS b', 'b.id', '=', 'trx_surat.employe')
                ->leftJoin('mst_role AS c', 'c.id', '=', 'trx_surat.role_id')
                ->leftJoin('mst_role AS d', 'd.id', '=', 'trx_surat.to_dept')
                ->where('trx_surat.is_active', 1)->orderBy('trx_surat.letter_admin', 'asc')->get();
        }

        $role        = DB::select("SELECT * FROM mst_role where id NOT IN (7) AND is_active=1");
        $data = array(
            'title' => 'Add Form',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );

        return view('Surat.input')->with($data);
    }

    function addform(Request $request): object
    {
        $table      = $request['table'];
        $dt         = $request['data'];
        $idn_user   = idn_user(auth::user()->id);
        $tgl        = Carbon::create($dt['date_release']);
        $bulan      = $tgl->format('m');
        $thn        = $tgl->format('Y');
        $blnromawi  = getRomawi($bulan);
        $dttodept   = $dt['to_dept'];
        $arr        = DB::select("SELECT * FROM trx_surat WHERE YEAR(date_release) = $thn AND to_dept = $dttodept");
        $jml        = count($arr) + 1;

        if ($dt['to_dept'] == 1) {
            $dtrole    = "ADDIR";
        } elseif ($dt['to_dept'] == 2) {
            $dtrole    = "HRGA";
        } elseif ($dt['to_dept'] == 3) {
            $dtrole    = "ADADM";
        } elseif ($dt['to_dept'] == 4) {
            $dtrole    = "ADFIN";
        } elseif ($dt['to_dept'] == 6) {
            $dtrole    = "ADDMKT";
        } else {
            $dtrole    = "NULL";
        }

        $tletter_admin  = sprintf("%03d", $jml) . "/" . $dtrole . "/" . $blnromawi . "/" . $thn;
        $data   = array(
            'letter_admin'  => $tletter_admin,
            'notes'         => $dt['notes'],
            'date_release'  => $dt['date_release'],
            'employe'       => $idn_user->id,
            'update_by'     => auth::user()->id,
            'to_dept'        => $dt['to_dept'],
            'role_id'       => $idn_user->role_id,
            'is_active' => 1,

        );

        // $data       = $request['data'];
        DB::table($table)->insert([$data]);
        return response('success');
    }

    function actioneditform(Request $request): object
    {
        $table      = $request['table'];
        $id         = $request['id'];
        $whr        = $request['whr'];
        $dt         = $request['dats'];

        $idn_user   = idn_user(auth::user()->id);
        $tgl        = Carbon::create($dt['date_release']);
        $bulan      = $tgl->format('m');
        $thn        = $tgl->format('Y');
        $blnromawi  = getRomawi($bulan);
        $dttodept   = $dt['to_dept'];
        $arr        = DB::select("SELECT * FROM trx_surat WHERE YEAR(date_release) = $thn AND to_dept = $dttodept");
        $jml        = count($arr) + 1;
        $dt_count   = sprintf("%03d", $jml);


        if ($dt['to_dept'] == 1) {
            $dtrole    = "ADDIR";
        } elseif ($dt['to_dept'] == 2) {
            $dtrole    = "HRGA";
        } elseif ($dt['to_dept'] == 3) {
            $dtrole    = "ADADM";
        } elseif ($dt['to_dept'] == 4) {
            $dtrole    = "ADFIN";
        } elseif ($dt['to_dept'] == 6) {
            $dtrole    = "ADDMKT";
        } else {
            $dtrole    = "NULL";
        }

        $expld_letter   = explode("/", $dt['letter_admin']);

        if ($dt['to_dept'] == $dt['to_dept_old']) {
            $count_sr       = $expld_letter[0];
        } else {
            $count_sr       = $dt_count;
        }

        $tletter_admin  = $count_sr . "/" . $dtrole . "/" . $blnromawi . "/" . $thn;

        $data   = array(
            'letter_admin'  => $tletter_admin,
            'notes'         => $dt['notes'],
            'date_release'  => $dt['date_release'],
            'employe'       => $idn_user->id,
            'to_dept'       => $dt['to_dept'],
            'role_id'       => $idn_user->role_id,
            'update_by' => auth::user()->id,

        );

        DB::table($table)->where($whr, $id)->update($data);
        return response('success');
    }

    // Upload Surat
    function upload_surat(Request $request): object{
        if ($request->hasFile('add_file')) {
            $fourRandomDigit = rand(10, 99999);
            $photo      = $request->file('add_file');
            $fileName   = $fourRandomDigit . '.' . $photo->getClientOriginalExtension();

            $path = public_path() . '/assets/file/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_file')->move($path, $fileName);

            return response($fileName);
        } else {
            return response('Failed');
        }
    }


    // Upload Image
    function upload_profile(Request $request): object
    {

        if ($request->hasFile('add_foto')) {
            $fourRandomDigit = rand(10, 99999);
            $photo      = $request->file('add_foto');
            $fileName   = $fourRandomDigit . '.' . $photo->getClientOriginalExtension();

            $path = public_path() . '/profile/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_foto')->move($path, $fileName);

            return response($fileName);
        } elseif ($request->hasFile('add_image')) {
            $fourRandomDigit = rand(10, 99999);
            $photo      = $request->file('add_image');
            $fileName   = $fourRandomDigit . '.' . $photo->getClientOriginalExtension();

            $path = public_path() . '/assets/image/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_image')->move($path, $fileName);

            return response($fileName);
        } elseif ($request->hasFile('add_file')) {
            $fourRandomDigit = rand(10, 99999);
            $photo      = $request->file('add_file');
            $fileName   = $fourRandomDigit . '.' . $photo->getClientOriginalExtension();

            $path = public_path() . '/assets/file/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_file')->move($path, $fileName);

            return response($fileName);
        } else {
            return response('Failed');
        }
    }

    // Action Add
    function actionadd(Request $request): object
    {
        $table      = $request['table'];
        $dt         = $request['data'];
        if ($table == 'users') {
            $data   = array(
                'username'  => $dt['username'],
                'password'  => Hash::make($dt['password']),
                'pass'      => $dt['password'],
                'role_id'   => $dt['role_id'],
                'name'      => $dt['name'],
                'email'     => $dt['email'],
                'no_tlp'    => $dt['no_tlp'],
                'foto'      => $dt['foto'],
                'is_active' => 1,
                'update_by' => 1,
            );
        } else {
            $data   = $request['data'];
        }
        // $data       = $request['data'];
        DB::table($table)->insert([$data]);
        return response('success');
    }

    // Action Edit
    function actionedit(Request $request): object
    {
        $table      = $request['table'];
        $id         = $request['id'];
        $whr        = $request['whr'];
        $dt         = $request['dats'];
        if ($table == 'users') {
            $data   = array(
                'username'  => $dt['username'],
                'password'  => Hash::make($dt['password']),
                'pass'      => $dt['password'],
                'role_id'   => $dt['role_id'],
                'name'      => $dt['name'],
                'email'     => $dt['email'],
                'no_tlp'    => $dt['no_tlp'],
                'foto'      => $dt['foto'],
                'update_by' => 1,
            );
        } else {
            $data   = $request['dats'];
        }

        DB::table($table)->where($whr, $id)->update($data);
        return response('success');
    }

    function actioneditwmulti(Request $request): object
    {
        $table      = $request['table'];
        $id1        = $request['id1'];
        $whr1       = $request['whr1'];
        $id2        = $request['id2'];
        $whr2       = $request['whr2'];
        $data       = $request['dats'];

        DB::table($table)->where($whr1, $id1)->where($whr2, $id2)->update($data);
        return response('success');
    }

    // Action Delete
    function actiondelete(Request $request): object
    {
        $table      = $request['table'];
        $id         = $request['id'];
        $whr        = $request['whr'];
        $data   = array(
            'is_active' => 0,
            'update_by' => auth::user()->id,
        );
        DB::table($table)->where($whr, $id)->update($data);
        return response('success');
    }

    // Action Show Data
    function actionshowdata(Request $request): object
    {
        $id     = $request['id'];
        $field  = $request['field'];
        $table  = $request['table'];
        $arr['data']    = DB::table($table)->where($field, $id)->first();
        return response($arr);
    }

    function actionshowdatawmulti(Request $request): object
    {
        $id1     = $request['id1'];
        $field1  = $request['field1'];
        $id2     = $request['id2'];
        $field2  = $request['field2'];
        $table   = $request['table'];
        $arr['data']    = DB::table($table)->where($field1, $id1)->where($field2, $id2)->first();
        return response($arr);
    }

    // Action List Data
    function actionlistdata(Request $request): object
    {
        if ($request['id'] == 0 || $request['id'] == null) {
            $id     = 1;
        } else {
            $id     = $request['id'];
        }
        $field  = $request['field'];
        $table  = $request['table'];
        $arr    = DB::select("SELECT * FROM $table WHERE $field=$id AND is_active=1 ");
        return response($arr);
    }


    // Peminjaman Asset
    function peminjamanasset()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $data = array(
            'title' => 'Peminjaman Asset',
            'arr'   => $arr,
            'idn_user' => $idn_user
        );
        return view('Surat.peminjamanasset')->with($data);
    }
}
