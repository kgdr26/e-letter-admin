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
        $whrrole    = collect(\DB::select("SELECT * FROM mst_role WHERE id='$idn_user->role_id'"))->first();
        $whrshow    = $whrrole->whr_show_surat;

        // if ($idn_user->role_id == 7) {
        //     $arr        = DB::table('trx_surat')->select('trx_surat.*', 'b.name as usr_name', 'c.name as usr_role', 'd.name as usr_to_dept')
        //         ->leftJoin('users AS b', 'b.id', '=', 'trx_surat.employe')
        //         ->leftJoin('mst_role AS c', 'c.id', '=', 'trx_surat.role_id')
        //         ->leftJoin('mst_role AS d', 'd.id', '=', 'trx_surat.to_dept')
        //         ->whereIn('trx_surat.role_id', [6,7])
        //         ->where('trx_surat.is_active', 1)
        //         ->orderBy('trx_surat.letter_admin', 'asc')->get();
        // } else {
        //     $arr        = DB::table('trx_surat')->select('trx_surat.*', 'b.name as usr_name', 'c.name as usr_role', 'd.name as usr_to_dept')
        //         ->leftJoin('users AS b', 'b.id', '=', 'trx_surat.employe')
        //         ->leftJoin('mst_role AS c', 'c.id', '=', 'trx_surat.role_id')
        //         ->leftJoin('mst_role AS d', 'd.id', '=', 'trx_surat.to_dept')
        //         ->where('trx_surat.is_active', 1)
        //         ->orderBy('trx_surat.letter_admin', 'asc')->get();
        // }

        $arr        = DB::table('trx_surat')->select('trx_surat.*', 'b.name as usr_name', 'c.name as usr_role', 'd.name as usr_to_dept')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_surat.employe')
            ->leftJoin('mst_role AS c', 'c.id', '=', 'trx_surat.role_id')
            ->leftJoin('mst_role AS d', 'd.id', '=', 'trx_surat.to_dept')
            ->where('trx_surat.is_active', 1)
            ->orderBy('trx_surat.letter_admin', 'asc')->get();


        $whrlist                = $whrrole->whr_input_surat;
        $roleinput              = DB::select("SELECT * FROM mst_role WHERE id IN ($whrlist)");
        $role                   = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Adm. Letter',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'roleinput' => $roleinput,
            'whrshow'   => $whrshow
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

        if ($dt['to_dept'] == 5) {
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
            'to_dept'       => $dt['to_dept'],
            'role_id'       => $idn_user->role_id,
            'is_active' => 1,

        );

        // $data       = $request['data'];
        DB::table($table)->insert([$data]);
        $arr['kode_letter'] = $tletter_admin;
        return response($arr);
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


        if ($dt['to_dept'] == 5) {
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
    function upload_surat(Request $request): object
    {
        if ($request->hasFile('add_file')) {
            $fourRandomDigit = rand(10, 99999);
            $photo      = $request->file('add_file');
            // $fileName   = $fourRandomDigit . '.' . $photo->getClientOriginalExtension();
            $fileName      = $photo->getClientOriginalName();

            $path = public_path() . '/assets/file/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_file')->move($path, $fileName);

            return response($fileName);
        } else {
            return response('Failed');
        }
    }


    // Upload File
    function upload_file(Request $request): object
    {
        if ($request->hasFile('add_file')) {
            $fourRandomDigit = rand(10, 99999);
            $photo      = $request->file('add_file');
            // $fileName   = $fourRandomDigit . '.' . $photo->getClientOriginalExtension();
            $fileName      = $photo->getClientOriginalName();

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
                'npk'      => $dt['npk'],
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
                'npk'      => $dt['npk'],
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
        $arr    = DB::select("SELECT * FROM $table WHERE $field='$id' AND is_active=1 ");
        return response($arr);
    }


    // Peminjaman Asset
    function peminjamanasset()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::select("SELECT name FROM mst_asset where is_active=1 GROUP BY name");
        $data = array(
            'title' => 'Lending Assets',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset
        );

        return view('Peminjaman.peminjamanasset')->with($data);
    }

    function assetsdash()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::select("SELECT name FROM mst_asset where is_active=1 GROUP BY name");
        $datatersedia   = '';
        $dataapphrga    = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('trx_assets_landing.status', 2)->get();
        $dataappscurity = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('trx_assets_landing.status', 4)->get();
        $dataappbalik   = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('trx_assets_landing.status', 5)->get();

        $data = array(
            'title' => 'Dashboard',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset,
            'dataapphrga'       => $dataapphrga,
            'dataappscurity'    => $dataappscurity,
            'dataappbalik'      => $dataappbalik
        );

        return view('Peminjaman.dashboard')->with($data);
    }

    function assetscreate()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::select("SELECT * FROM mst_asset where is_active=1");
        $type       = DB::select("SELECT kategori FROM mst_asset where is_active=1 GROUP BY kategori");
        $data = array(
            'title' => 'Create Form',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset,
            'type'  => $type
        );

        return view('Peminjaman.create')->with($data);
    }

    function assetsdephed()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $whrrole    = collect(\DB::select("SELECT * FROM mst_role WHERE id='$idn_user->role_id'"))->first();
        $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'b.role_id', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('trx_assets_landing.status', 1)->get();

        $data = array(
            'title' => 'DepHead Approve',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset,
            'whrrole' => $whrrole
        );

        return view('Peminjaman.dephed')->with($data);
    }

    function assetsfirst()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no', 'c.kategori as ast_kat')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('trx_assets_landing.status', 2)->get();
        $data = array(
            'title' => 'HRGA Approve',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset
        );

        return view('Peminjaman.first')->with($data);
    }

    function assetssecond()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('trx_assets_landing.status', 3)->get();
        $data = array(
            'title' => 'Security',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset
        );

        return view('Peminjaman.second')->with($data);
    }

    function assetsdirector()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('trx_assets_landing.status', 4)->get();
        $data = array(
            'title' => 'Returned',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset
        );

        return view('Peminjaman.director')->with($data);
    }

    function assetsdata()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')->orderBy('trx_assets_landing.id', 'desc')->get();
        $data = array(
            'title' => 'Show Lending Assets',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'asset' => $asset
        );

        return view('Peminjaman.data')->with($data);
    }

    function dataasset()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset       = DB::select("SELECT * FROM mst_asset where is_active=1");
        // $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
        //     ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
        //     ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
        //     ->where('trx_assets_landing.status', 2)->get();
        $data = array(
            'title' => 'Show Data Assets',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role' => $role,
            'asset'  => $asset
        );

        return view('Peminjaman.dataasset')->with($data);
    }

    function assetscall()
    {
        $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')->get();
        $events = [];
        foreach ($asset as $key => $val) {
            $events[] = [
                'id'        => $val->id,
                'title'     => $val->ast_name . ' - ' . $val->ast_no . ' (' . $val->usr_name . ')',
                'tglstart'  => $val->date_start,
                'tglend'    => $val->date_end,
                'start'     => $val->date_start,
                'end'       => $val->date_end,
            ];
        }

        return response()->json($events);
    }

    function scurity()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $asset      = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')->get();
        $data = array(
            'title'     => 'Security',
            'arr'       => $arr,
            'idn_user'  => $idn_user,
            'role'      => $role,
            'asset'     => $asset
        );

        return view('Peminjaman.second')->with($data);
    }

    function detaildataassets(Request $request): object
    {
        $no_assets  = $request['no_assets'];
        $date       = date('Y-m-d');
        $arr['data']    = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no', 'c.merk as ast_merk', 'c.tahun as ast_tahun', 'c.lokasi as ast_lokasi', 'c.kepemilikan as ast_kepemilikan')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->where('c.no_assets', $no_assets)
            ->where('trx_assets_landing.date_start', 'LIKE', '%' . $date . '%')->first();
        return response($arr);
    }

    function assetscheck(Request $request): object
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $assets     = DB::table('mst_asset')->where('kategori', 'Mobil')->where('is_active', 1)->get();

        $data = array(
            'title'     => 'Checksheet Assets',
            'arr'       => $arr,
            'idn_user'  => $idn_user,
            'role'      => $role,
            'assets'    => $assets
        );

        return view('Checksheet.list')->with($data);
    }

    function assetchecksheetcall()
    {
        $asset      = DB::table('trx_chceksheet_asset')->select('trx_chceksheet_asset.*', 'b.name as usr_name', 'c.name as ast_name', 'c.no_assets as ast_no')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_chceksheet_asset.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_chceksheet_asset.id_asset')->get();
        $events = [];
        foreach ($asset as $key => $val) {
            if ($val->type == 1) {
                $color  = '#59B4C3';
                $ket    = "Perpanjang Pajak";
            } else {
                $color = '#74E291';
                $ket    = "Service";
            }
            $events[] = [
                'id'    => $val->id,
                'title' => $val->ast_name . ' - ' . $val->ast_no . ' (' . $ket . ')',
                'keterangan' => $val->keterangan,
                'start' => $val->tanggal,
                'end'   => $val->tanggal,
                'color' => $color
            ];
        }

        return response()->json($events);
    }

    function document()
    {
        $idn_user       = idn_user(auth::user()->id);
        $arr            = DB::select("SELECT * FROM trx_folder where is_active=1");
        $role           = DB::select("SELECT * FROM mst_role where is_active=1");
        $countingfile   = countingfile();
        $data = array(
            'title' => 'Document',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'countingfile'  => $countingfile
        );

        return view('Document.folder')->with($data);
    }

    function detaildocument(Request $request)
    {

        $id_folder   = $request['id_folder'];
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::table('trx_file')->select('trx_file.*', 'b.name as role_name')
            ->leftJoin('mst_role AS b', 'b.id', '=', 'trx_file.to_dept')
            ->where('trx_file.id_folder', $id_folder)
            ->where('trx_file.is_active', 1)->get();
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Detail Document',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'id_folder' => $id_folder
        );

        return view('Document.detailfolder')->with($data);
    }

    function maincekketersediaanassets(Request $request)
    {
        $reqbooking  = $request['reqbooking'];
        $kategori  = $request['kategori'];
        $date_start  = $request['date_start'];
        $date_end  = $request['date_end'];
        $arr = cekketersediaanassets($reqbooking, $kategori, $date_start, $date_end);
        return response($arr);
    }

    function showdetailtimeline(Request $request)
    {
        $id         = $request['id'];
        $listdata    = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name as usr_name', 'b.npk', 'c.name as ast_name', 'c.no_assets as ast_no', 'd.name as updt_name')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('users AS d', 'd.id', '=', 'trx_assets_landing.update_by')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')->where('trx_assets_landing.id', $id)->first();
        // $detailtimeline = detailtimeline($id);

        $arr['listdata']    = $listdata;
        // $arr['timeline']    = $detailtimeline;

        return $arr;
    }

    function employeloan()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::table('trx_employe_loan')->select('trx_employe_loan.*', 'b.name', 'b.npk')
            ->leftJoin('mst_karyawan AS b', 'b.id', '=', 'trx_employe_loan.id_karyawan')->where('trx_employe_loan.is_active', 1)->orderBy('trx_employe_loan.id', 'desc')->get();
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $listkarayawan  = DB::select("SELECT * FROM mst_karyawan where is_active=1");
        $filterkaryawan = DB::table('trx_employe_loan')->select('trx_employe_loan.*', 'b.name', 'b.npk', 'b.id as id_kry')
            ->leftJoin('mst_karyawan AS b', 'b.id', '=', 'trx_employe_loan.id_karyawan')->where('trx_employe_loan.is_active', 1)->orderBy('trx_employe_loan.id', 'desc')->get();
        $listbulanthr   = DB::table('trx_setting_bulan_thr')->select('trx_setting_bulan_thr.*', 'b.name')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_setting_bulan_thr.update_by')->where('trx_setting_bulan_thr.is_active', 1)->orderBy('trx_setting_bulan_thr.id', 'desc')->get();
        $data = array(
            'title' => 'Employe Loan',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'listkarayawan' => $listkarayawan,
            'filterkaryawan' => $filterkaryawan,
            'listbulanthr'  => $listbulanthr
        );

        return view('Employeloan.list')->with($data);
    }

    function employeloanperuser()
    {
        $idn_user   = idn_user(auth::user()->id);
        $idusr      = auth::user()->id;
        $cruser     = collect(\DB::select("SELECT * FROM users WHERE id='$idusr' AND is_active='1'"))->first();
        $npk        = str_replace(' ', '', $cruser->npk);
        $kry_id     = collect(\DB::select("SELECT * FROM mst_karyawan WHERE npk='$npk'"))->first();
        $id_karyawan = $kry_id->id;
        $listkry    = collect(\DB::select("SELECT * FROM trx_employe_loan WHERE id_karyawan='$id_karyawan' AND is_active='1'"))->first();
        // if($listkry){
        //     $arr        = json_decode($listkry->list_pembayaran);
        // }else{
        //     $arr        = [];
        // }

        $listloan   = DB::table('trx_employe_loan')->where('id_karyawan', $id_karyawan)->get();
        if (count($listloan) == 0) {
            $arr   = [];
            $idadaloan = null;
        } else {
            $arr   = DB::table('trx_employe_loan')->where('id_karyawan', $id_karyawan)->get();
            foreach ($arr as $key => $val) {
                $idadaloan = $val->id;
            }
        }

        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Employe Loan',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'idkaryawan' => $id_karyawan,
            'namekaryawan' => $kry_id->name,
            'role'  => $role,
            'idadaloan' => $idadaloan
        );

        return view('Employeloan.peruser')->with($data);
    }

    function dataemploye(Request $request)
    {
        $type     = $request['type'];
        $bulan    = $request['bulan'];
        $idkry    = $request['idkry'];
        $idloan   = $request['idloan'];
        $arr    = showdataemploye($type, $bulan, $idkry, $idloan);
        return response($arr);
    }

    function dataemployeperuser(Request $request)
    {
        $id     = $request['id'];
        $arr    = showdataloanperuser($id);
        return response($arr);
    }

    function action_autogenerateloan(Request $request)
    {
        $arr    = autogenerateloan();
        return response($arr);
    }

    function showlistdataloanperuser(Request $request)
    {
        $id     = $request['id'];
        $arr    = action_showlistdataloanperuser($id);
        return response($arr);
    }

    function listtableloanperuser(Request $request)
    {
        $id     = $request['id'];
        $arr    = action_listtableloanperuser($id);
        return response($arr);
    }

    function actionpelunasanloan(Request $request)
    {
        $id         = $request['id'];
        $bulan      = $request['bulan'];
        $nominal    = $request['nominal'];
        $arr        = actionpelunasanloan($id, $bulan, $nominal);
        return response($arr);
    }

    function showdatapelunasanloan(Request $request)
    {
        $id     = $request['id'];
        $bulan  = $request['bulan'];
        $arr    = showdatapelunasanloan($id, $bulan);
        return response($arr);
    }

    function exportallloan()
    {
        // Load the template file
        $templatePath = public_path() . '/template/tmp_loan.xlsx';
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Example data
        // $data = [
        //     ['John Doe', 'john@example.com', 28],
        //     ['Jane Doe', 'jane@example.com', 32],
        //     ['Alice Smith', 'alice@example.com', 24],
        // ];

        $arr        = DB::table('trx_employe_loan')->select('trx_employe_loan.*', 'b.name', 'b.npk')
            ->leftJoin('mst_karyawan AS b', 'b.id', '=', 'trx_employe_loan.id_karyawan')
            ->where('trx_employe_loan.is_active', 1)
            ->orderBy('trx_employe_loan.id', 'desc')->get();

        // Assuming your template has headers in the first row
        $startRow = 2; // Data starts from the second row
        $no       = 1;
        foreach ($arr as $index => $val) {
            $sheet->setCellValue('A' . ($startRow + $index), $no++);
            $sheet->setCellValue('B' . ($startRow + $index), $val->name);
            $sheet->setCellValue('C' . ($startRow + $index), $val->npk);
            $sheet->setCellValue('D' . ($startRow + $index), $val->golongan);
            $sheet->setCellValue('E' . ($startRow + $index), 'Rp ' . number_format($val->nominal_loan, 0, ',', '.'));
            $sheet->setCellValue('F' . ($startRow + $index), $val->bulan_loan . ' Bulan');
            $sheet->setCellValue('G' . ($startRow + $index), 'Rp ' . number_format($val->loan_perbulan, 0, ',', '.'));
        }

        // Create a file name
        $fileName = 'Rekap_Loan.xlsx';

        // Create a StreamedResponse to output the Excel file to the browser
        $response = new StreamedResponse(function () use ($spreadsheet, $fileName) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        // Set the headers for the response
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        $response->headers->set('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->headers->set('Cache-Control', 'cache, must-revalidate');
        $response->headers->set('Pragma', 'public');

        return $response;
    }

    function exportassetslanding(Request $request)
    {
        // Load the template file
        $templatePath = public_path() . '/template/tmp_assets_landing.xlsx';
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        $bln    = $request['select_bulan'];
        // $whrin  = $request['kategori'];
        $dataarr    = explode("/", $bln);
        $whrin      = $dataarr[0];
        $startDate  = $dataarr[1] . '-01';
        $endDate    = $dataarr[2] . '-01';

        $arr    = DB::table('trx_assets_landing')->select('trx_assets_landing.*', 'b.name', 'b.npk', 'c.no_assets', 'c.name AS nameass', 'c.merk')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_assets_landing.id_user')
            ->leftJoin('mst_asset AS c', 'c.id', '=', 'trx_assets_landing.data_asset')
            ->whereIn('c.kategori', [$whrin])
            ->whereBetween(DB::raw('DATE(trx_assets_landing.date_start)'), [$startDate, $endDate])
            // ->where('trx_assets_landing.date_start', 'LIKE', '%' . $bln . '%')
            ->orderBy('trx_assets_landing.id', 'desc')->get();

        // Assuming your template has headers in the first row
        $startRow = 2; // Data starts from the second row
        $no       = 1;
        foreach ($arr as $index => $val) {
            $sheet->setCellValue('A' . ($startRow + $index), $no++);
            $sheet->setCellValue('B' . ($startRow + $index), $val->name);
            $sheet->setCellValue('C' . ($startRow + $index), $val->npk);
            $sheet->setCellValue('D' . ($startRow + $index), $val->date_start);
            $sheet->setCellValue('E' . ($startRow + $index), $val->date_end);
            $sheet->setCellValue('F' . ($startRow + $index), $val->nameass . ' (' . $val->merk . ')');
            $sheet->setCellValue('G' . ($startRow + $index), $val->no_assets);
            $sheet->setCellValue('H' . ($startRow + $index), $val->necessity);
            if ($val->status == 1) {
                $sts    = 'Create Form';
            } elseif ($val->status == 2) {
                $sts    = 'Approve Dephed';
            } elseif ($val->status == 3) {
                $sts    = 'Approve HRGA';
            } elseif ($val->status == 4) {
                $sts    = 'Validate';
            } elseif ($val->status == 5) {
                $sts    = 'Returned';
            } elseif ($val->status == 6) {
                $sts    = 'Rejected';
            } else {
                $sts    = 'Approved';
            }
            $sheet->setCellValue('I' . ($startRow + $index), $sts);
        }

        // Create a file name
        $fileName = 'Rekap_Assets_landing.xlsx';

        // Create a StreamedResponse to output the Excel file to the browser
        $response = new StreamedResponse(function () use ($spreadsheet, $fileName) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        // Set the headers for the response
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        $response->headers->set('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->headers->set('Cache-Control', 'cache, must-revalidate');
        $response->headers->set('Pragma', 'public');

        return $response;
    }

    // E-Ticket
    function ticket_request()
    {
        $idn_user   = idn_user(auth::user()->id);
        $wherein    = collect(\DB::select("SELECT * FROM mst_role WHERE id='$idn_user->role_id'"))->first();
        $datawhrdept    = collect(\DB::select("SELECT * FROM mst_departement WHERE role_dh='$idn_user->role_id'"))->first();

        $arr        = DB::table('trx_ticket_request')->select('trx_ticket_request.*', 'b.name AS sts_name', 'c.name AS usr_name', 'd.name AS pic_name')
            ->leftJoin('mst_status_ticket AS b', 'b.id', '=', 'trx_ticket_request.status')
            ->leftJoin('users AS c', 'c.id', '=', 'trx_ticket_request.user_create')
            ->leftJoin('users AS d', 'd.id', '=', 'trx_ticket_request.update_by')
            ->orderBy('trx_ticket_request.id', 'desc')->get();


        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $dep        = DB::select("SELECT * FROM mst_departement where is_active=1");
        $data = array(
            'title' => 'E-Ticket Request IT',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'wherein' => $wherein,
            'dep'   => $dep
        );

        return view('Ticket.list')->with($data);
    }

    function addticketrequest(Request $request)
    {
        $departement    = $request['departement'];
        $summary        = $request['summary'];
        $description    = $request['description'];
        $file_name      = $request['file_name'];

        $ticket         = DB::table('trx_ticket_request')->get();
        $jml            = count($ticket) + 1;
        $id_ticket      = 'ADS.' . date('ymd') . '.' . sprintf("%04d", $jml);
        $data   = array(
            'id_ticket'     => $id_ticket,
            'departement'   => $departement,
            'summary'       => $summary,
            'description'   => $description,
            'file_name'     => $file_name,
            'user_create'   => auth::user()->id,
            'status'        => 1,
            'is_active'     => 1,
            'update_by'     => auth::user()->id
        );

        // $data       = $request['data'];
        DB::table('trx_ticket_request')->insert([$data]);
        return response('success');
    }

    function editticketrequest(Request $request)
    {
        $id         = $request['id'];
        $update_by  = auth::user()->id;

        if ($request['step'] == 0) {
            $data   = array(
                'departement'   => $request['departement'],
                'summary'       => $request['summary'],
                'description'   => $request['description'],
                'file_name'     => $request['file_name'],
                'update_by'     => $update_by
            );
            DB::table('trx_ticket_request')->where('id', $id)->update($data);
        } else {
            $data   = array(
                'note'          => $request['note'],
                'status'        => $request['step'],
                'due_date'      => $request['due_date'],
                'update_by'     => $update_by
            );
            DB::table('trx_ticket_request')->where('id', $id)->update($data);
        }
        return response('success');
    }

    function showdataticket(Request $request)
    {
        $id     = $request['id'];
        $data    = DB::table('trx_ticket_request')->select('trx_ticket_request.*', 'b.name AS sts_name', 'c.npk AS usr_npk', 'c.no_tlp AS usr_tlp', 'c.email AS usr_eemail', 'c.name AS usr_name')
            ->leftJoin('mst_status_ticket AS b', 'b.id', '=', 'trx_ticket_request.status')
            ->leftJoin('users AS c', 'c.id', '=', 'trx_ticket_request.user_create')
            ->where('trx_ticket_request.id', $id)->first();
        return response()->json($data);
    }

    function exportrequestticket(Request $request)
    {
        // Load the template file
        $templatePath = public_path() . '/template/tmp_request_ticket.xlsx';
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        $bln    = $request['select_bulan'];
        $whrin  = $request['kategori'];
        $arr    = DB::table('trx_ticket_request')->select('trx_ticket_request.*', 'b.name AS sts_name', 'c.name AS usr_name', 'd.name AS pic_name')
            ->leftJoin('mst_status_ticket AS b', 'b.id', '=', 'trx_ticket_request.status')
            ->leftJoin('users AS c', 'c.id', '=', 'trx_ticket_request.user_create')
            ->leftJoin('users AS d', 'd.id', '=', 'trx_ticket_request.update_by')
            ->where('trx_ticket_request.date_create', 'LIKE', '%' . $bln . '%')
            ->orderBy('trx_ticket_request.id', 'desc')->get();

        // Assuming your template has headers in the first row
        $startRow = 2; // Data starts from the second row
        $no       = 1;
        foreach ($arr as $index => $val) {
            $sheet->setCellValue('A' . ($startRow + $index), $no++);
            $sheet->setCellValue('B' . ($startRow + $index), $val->id_ticket);
            $sheet->setCellValue('C' . ($startRow + $index), $val->usr_name);
            $sheet->setCellValue('D' . ($startRow + $index), $val->date_create);
            $sheet->setCellValue('E' . ($startRow + $index), $val->summary);
            $sheet->setCellValue('F' . ($startRow + $index), $val->description);
            $sheet->setCellValue('G' . ($startRow + $index), $val->due_date);
            $sheet->setCellValue('H' . ($startRow + $index), $val->last_update);
            $sheet->setCellValue('I' . ($startRow + $index), $val->sts_name);
            $sheet->setCellValue('J' . ($startRow + $index), $val->note);
            $sheet->setCellValue('K' . ($startRow + $index), $val->pic_name);
        }

        // Create a file name
        $fileName = 'Rekap_Request_Ticket.xlsx';

        // Create a StreamedResponse to output the Excel file to the browser
        $response = new StreamedResponse(function () use ($spreadsheet, $fileName) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        // Set the headers for the response
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        $response->headers->set('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->headers->set('Cache-Control', 'cache, must-revalidate');
        $response->headers->set('Pragma', 'public');

        return $response;
    }

    // End E-Ticket

    // Report E-Letter
    function exportsuratadmin(Request $request)
    {
        // Load the template file
        $templatePath = public_path() . '/template/tmp_letter_admin.xlsx';
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        $date_release    = $request['select_bulan'];
        $dataarr    = explode("/", $date_release);
        $startDate  = $dataarr[0];
        $endDate    = $dataarr[1];

        $arr    = DB::table('trx_surat')->select('trx_surat.*', 'b.name as usr_name', 'c.name as usr_role', 'd.name as usr_to_dept')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_surat.employe')
            ->leftJoin('mst_role AS c', 'c.id', '=', 'trx_surat.role_id')
            ->leftJoin('mst_role AS d', 'd.id', '=', 'trx_surat.to_dept')
            ->where('trx_surat.is_active', 1)
            // ->where('trx_surat.date_release', $date_release)
            ->whereBetween(DB::raw('DATE(trx_surat.date_release)'), [$startDate, $endDate])
            ->orderBy('trx_surat.letter_admin', 'asc')->get();

        // Assuming your template has headers in the first row
        $startRow = 2; // Data starts from the second row
        $no       = 1;
        foreach ($arr as $index => $val) {
            $sheet->setCellValue('A' . ($startRow + $index), $no++);
            $sheet->setCellValue('B' . ($startRow + $index), $val->letter_admin);
            $sheet->setCellValue('C' . ($startRow + $index), $val->notes);
            $sheet->setCellValue('D' . ($startRow + $index), $val->usr_role);
            $sheet->setCellValue('E' . ($startRow + $index), \Carbon\Carbon::parse($val->date_release)->isoFormat('dddd, DD MMM YYYY'));
            $sheet->setCellValue('F' . ($startRow + $index), $val->usr_name);
            $sheet->setCellValue('G' . ($startRow + $index), $val->usr_to_dept);
            $sheet->setCellValue('H' . ($startRow + $index), \Carbon\Carbon::parse($val->last_update)->isoFormat('dddd, DD MMM YYYY HH:mm:ss'));
            $sheet->setCellValue('I' . ($startRow + $index), $val->name_file);
        }

        // Create a file name
        $fileName = 'Report_Surat_admin.xlsx';

        // Create a StreamedResponse to output the Excel file to the browser
        $response = new StreamedResponse(function () use ($spreadsheet, $fileName) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        // Set the headers for the response
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        $response->headers->set('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->headers->set('Cache-Control', 'cache, must-revalidate');
        $response->headers->set('Pragma', 'public');

        return $response;
    }

    // End Report E-Letter

    // Cash In Advance
    function inputcia()
    {
        $idn_user   = idn_user(auth::user()->id);
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Cash In Advance',
            'idn_user' => $idn_user,
            'role'  => $role
        );

        return view('CashInAdvance.input')->with($data);
    }

    function listinputcia()
    {
        $id_user    = auth::user()->id;
        $dat        = DB::table('trx_cia')->where('is_active', 1)->where('id_user', $id_user)->get();
        $arr        = [];

        foreach ($dat as $key => $val) {
            $arr[$key]['id']  = $val->id;
            $arr[$key]['no_cia']  = $val->no_cia;
            $arr[$key]['create_on']  = $val->date_create;
            $arr[$key]['necessity']  = $val->necessity;
            $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            $arr[$key]['unit']  = $val->unit;
            $text_status    = '';
            if ($val->status == 1) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 2) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Dephead</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 25%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 3) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Finance</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 50%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 4) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 5) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Paid</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 75%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 6) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Settlement</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 7) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="danger" style="font-size: 0.7rem">Oustandaing</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 8) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Finish</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 0) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="danger" style="font-size: 0.7rem">Reject</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } else {
                // $text_status    = 'Delete';
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            }
            $arr[$key]['status']  = $text_status;
            $arr[$key]['modified']  = $val->last_update;
            $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            $arr[$key]['remark']  = $val->remark;
            if ($val->status == 2) {
                $arr[$key]['action']  = '<button disabled type="button" class="btn btn-outline-info btn-sm" data-name="edit" data-item="' . $val->id . '"><i class="bi bi-pencil-square"></i></button>
                <button disabled type="button" class="btn btn-outline-danger btn-sm" data-name="delete" data-item="' . $val->id . '"><i class="bi bi-trash-fill"></i></button>';
            } elseif ($val->status == 3) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-info btn-sm" data-name="print_to_casier" data-item="' . $val->id . '"><i class="bi bi-printer-fill"></i></button>';
            } elseif ($val->status == 4) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-info btn-sm" data-name="show_app_chasier" data-item="' . $val->id . '"><i class="bi bi-printer-fill"></i></button>';
            } elseif ($val->status == 5) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-info btn-sm" data-name="show_app_chasier" data-item="' . $val->id . '"><i class="bi bi-printer-fill"></i></button>';
            } elseif ($val->status == 1) {
                $arr[$key]['action']  = '<button disabled type="button" class="btn btn-outline-info btn-sm" data-name="edit" data-item="' . $val->id . '"><i class="bi bi-pencil-square"></i></button>
                <button disabled type="button" class="btn btn-outline-danger btn-sm" data-name="delete" data-item="' . $val->id . '"><i class="bi bi-trash-fill"></i></button>';
            } else {
                $arr[$key]['action']  = '';
            }
        }

        return response($arr);
    }

    function cekdatacia(Request $request): object
    {
        $id_user    = auth::user()->id;
        $dat        = DB::table('trx_cia')->where('status', '>', 0)->where('is_active', 1)->where('id_user', $id_user)->get();
        $cek        = 0;
        // $arr        = [];
        $html       = '';
        $no         = 1;
        foreach ($dat as $key => $val) {
            if ($val->status < 8) {
                $html .= '<tr><td>' . $no++ . '</td>';
                $html .= '<td>' . $val->no_cia . '</td>';
                $html .= '<td>' . $val->date_create . '</td>';
                $html .= '<td>' . $val->necessity . '</td>';
                $html .= '<td>Rp ' . number_format($val->amount, 0, ',', '.') . '</td>';
                $html .= '<td>' . $val->unit . '</td>';
                $text_status    = '';
                if ($val->status == 1) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } elseif ($val->status == 2) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Dephead</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 25%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } elseif ($val->status == 3) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Finance</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 50%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } elseif ($val->status == 4) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } elseif ($val->status == 5) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Paid</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 75%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } elseif ($val->status == 6) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Settlement</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } elseif ($val->status == 7) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="danger" style="font-size: 0.7rem">Oustandaing</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } elseif ($val->status == 0) {
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="danger" style="font-size: 0.7rem">Reject</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                } else {
                    // $text_status    = 'Delete';
                    $text_status    .= '<figure class="figure-progress-bar">';
                    $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Draft</figcaption>';
                    $text_status    .= '<div class="progress">';
                    $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                    $text_status    .= '</div>';
                    $text_status    .= '</figure>';
                }
                $html .= '<td class="text-center">' . $text_status . '</td></tr>';

                $cek += 1;
            }
        }

        $arr['cek'] = $cek;
        $arr['html'] = $html;
        return response($arr);
    }

    function inpinputcia(Request $request): object
    {
        $id_user    = auth::user()->id;
        $dat        = DB::table('trx_cia')->where('is_active', 1)->where('id_user', $id_user)->get();
        $jml        = count($dat) + 1;
        $no_cia     = 'CIA.' . date('Y-m') . '.' . sprintf("%04d", $jml);

        $data   = array(
            'id_user'   => $id_user,
            'no_cia'    => $no_cia,
            'date_create'  => $request['date_create'],
            'necessity'  => $request['necessity'],
            'amount'  => $request['amount'],
            'unit'  => $request['unit'],
            'remark' => $request['remark'],
            'status'  => 1,
            'is_active' => 1,
            'update_by' => $id_user
        );

        DB::table('trx_cia')->insert([$data]);
        return response('success');
    }

    function showdatainputcia(Request $request): object
    {
        $id         = $request['id'];
        $arr        = DB::table('trx_cia')->select('trx_cia.*', 'a.name as name_user', 'b.name as name_dephead', 'c.name as name_finance')
            ->leftJoin('users AS a', 'a.id', '=', 'trx_cia.id_user')
            ->leftJoin('users AS b', 'b.id', '=', 'trx_cia.id_dephead')
            ->leftJoin('users AS c', 'c.id', '=', 'trx_cia.id_finance')
            ->where('trx_cia.id', $id)->first();

        return response()->json($arr);
    }

    function listciadephead()
    {
        $idn_user   = idn_user(auth::user()->id);
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Cash In Advance',
            'idn_user' => $idn_user,
            'role'  => $role
        );

        return view('CashInAdvance.dephead')->with($data);
    }

    function looplistciadephead()
    {
        $dat        = DB::table('trx_cia')->where('status', 1)->get();
        $arr        = [];

        foreach ($dat as $key => $val) {
            $arr[$key]['id']  = $val->id;
            $arr[$key]['no_cia']  = $val->no_cia;
            $requested        = DB::table('users')->where('id', $val->id_user)->first();
            $arr[$key]['requested']  = $requested->name;
            $arr[$key]['create_on']  = $val->date_create;
            $arr[$key]['necessity']  = $val->necessity;
            $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            $arr[$key]['unit']  = $val->unit;
            if ($val->status == 1) {
                $na        = DB::table('users')->where('id', $val->id_user)->first();
                $text_status    = 'CREATE <br> By <br>' . $na->name;
            } elseif ($val->status == 2) {
                $na        = DB::table('users')->where('id', $val->id_dephead)->first();
                $text_status    = 'APPROVE DEPHEAD <br> By <br>' . $na->name;
            } elseif ($val->status == 3) {
                $na        = DB::table('users')->where('id', $val->id_finance)->first();
                $text_status    = 'APPROVE FINANCE <br> By <br>' . $na->name;
            } else {
                $text_status    = 'Delete';
            }
            $arr[$key]['status']  = $text_status;
            $arr[$key]['modified']  = $val->last_update;
            $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            $arr[$key]['remark']  = $val->remark;
            $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="approve" data-item="' . $val->id . '"><i class="bi bi-check2-all"></i></button>
            <button type="button" class="btn btn-outline-danger btn-sm" data-name="reject" data-item="' . $val->id . '" data-note="' . $val->remark . '"><i class="bi bi-x-circle"></i></button>';
        }

        return response($arr);
    }

    function approvedepheadcia(Request $request): object
    {
        $id_user    = auth::user()->id;
        $id         = $request['id'];

        $data   = array(
            'id_dephead' => $id_user,
            'status'  => 2,
            'update_by' => $id_user
        );

        DB::table('trx_cia')->where('id', $id)->update($data);
        return response('success');
    }

    function listciafinance()
    {
        $idn_user   = idn_user(auth::user()->id);
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Cash In Advance',
            'idn_user' => $idn_user,
            'role'  => $role
        );

        return view('CashInAdvance.finance')->with($data);
    }

    function looplistciafinance()
    {
        $dat        = DB::table('trx_cia')->whereIn('status', [2, 6, 7])->get();
        $arr        = [];

        foreach ($dat as $key => $val) {
            $arr[$key]['id']  = $val->id;
            $arr[$key]['no_cia']  = $val->no_cia;
            $requested        = DB::table('users')->where('id', $val->id_user)->first();
            $arr[$key]['requested']  = $requested->name;
            $arr[$key]['create_on']  = $val->date_create;
            $arr[$key]['necessity']  = $val->necessity;
            $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            $arr[$key]['unit']  = $val->unit;
            if ($val->status == 1) {
                $na        = DB::table('users')->where('id', $val->id_user)->first();
                $text_status    = 'CREATE <br> By <br>' . $na->name;
            } elseif ($val->status == 2) {
                $na        = DB::table('users')->where('id', $val->id_dephead)->first();
                $text_status    = 'APPROVE DEPHEAD <br> By <br>' . $na->name;
            } elseif ($val->status == 3) {
                $na        = DB::table('users')->where('id', $val->id_finance)->first();
                $text_status    = 'APPROVE FINANCE <br> By <br>' . $na->name;
            } else {
                $text_status    = 'Delete';
            }
            $arr[$key]['status']  = $text_status;
            $arr[$key]['modified']  = $val->last_update;
            $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            $arr[$key]['remark']  = $val->remark;
            if ($val->status == 2) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="approve" data-item="' . $val->id . '"><i class="bi bi-check2-all"></i></button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-name="reject" data-item="' . $val->id . '" data-note="' . $val->remark . '"><i class="bi bi-x-circle"></i></button>';
            } elseif ($val->status == 6) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="slisih_action" data-item="' . $val->id . '"><i class="bi bi-pencil-square"></i></button>';
            } elseif ($val->status == 7) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="closecia" data-item="' . $val->id . '"><i class="bi bi-check2-square"></i></button>';
            }

            // if($val->status == 2){
            //     $arr[$key]['id']  = $val->id;
            //     $arr[$key]['no_cia']  = $val->no_cia;
            //     $requested        = DB::table('users')->where('id', $val->id_user)->first();
            //     $arr[$key]['requested']  = $requested->name;
            //     $arr[$key]['create_on']  = $val->date_create;
            //     $arr[$key]['necessity']  = $val->necessity;
            //     $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            //     $arr[$key]['unit']  = $val->unit;
            //     if($val->status == 1){
            //         $na        = DB::table('users')->where('id', $val->id_user)->first();
            //         $text_status    = 'CREATE <br> By <br>'.$na->name;
            //     }elseif($val->status == 2){
            //         $na        = DB::table('users')->where('id', $val->id_dephead)->first();
            //         $text_status    = 'APPROVE DEPHEAD <br> By <br>'.$na->name;
            //     }elseif($val->status == 3){
            //         $na        = DB::table('users')->where('id', $val->id_finance)->first();
            //         $text_status    = 'APPROVE FINANCE <br> By <br>'.$na->name;
            //     }else{
            //         $text_status    = 'Delete';
            //     }
            //     $arr[$key]['status']  = $text_status;
            //     $arr[$key]['modified']  = $val->last_update;
            //     $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            //     $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            //     $arr[$key]['remark']  = $val->remark;
            //     $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="approve" data-item="'.$val->id.'"><i class="bi bi-check2-all"></i></button>
            //     <button type="button" class="btn btn-outline-danger btn-sm" data-name="reject" data-item="'.$val->id.'" data-note="'.$val->remark.'"><i class="bi bi-x-circle"></i></button>';
            // }elseif($val->status == 6){
            //     $arr[$key]['id']  = $val->id;
            //     $arr[$key]['no_cia']  = $val->no_cia;
            //     $requested        = DB::table('users')->where('id', $val->id_user)->first();
            //     $arr[$key]['requested']  = $requested->name;
            //     $arr[$key]['create_on']  = $val->date_create;
            //     $arr[$key]['necessity']  = $val->necessity;
            //     $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            //     $arr[$key]['unit']  = $val->unit;
            //     if($val->status == 1){
            //         $na        = DB::table('users')->where('id', $val->id_user)->first();
            //         $text_status    = 'CREATE <br> By <br>'.$na->name;
            //     }elseif($val->status == 2){
            //         $na        = DB::table('users')->where('id', $val->id_dephead)->first();
            //         $text_status    = 'APPROVE DEPHEAD <br> By <br>'.$na->name;
            //     }elseif($val->status == 3){
            //         $na        = DB::table('users')->where('id', $val->id_finance)->first();
            //         $text_status    = 'APPROVE FINANCE <br> By <br>'.$na->name;
            //     }else{
            //         $text_status    = 'Delete';
            //     }
            //     $arr[$key]['status']  = $text_status;
            //     $arr[$key]['modified']  = $val->last_update;
            //     $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            //     $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            //     $arr[$key]['remark']  = $val->remark;
            //     $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="slisih_action" data-item="'.$val->id.'"><i class="bi bi-pencil-square"></i></button>';
            // }elseif($val->status == 7){
            //     $arr[$key]['id']  = $val->id;
            //     $arr[$key]['no_cia']  = $val->no_cia;
            //     $requested        = DB::table('users')->where('id', $val->id_user)->first();
            //     $arr[$key]['requested']  = $requested->name;
            //     $arr[$key]['create_on']  = $val->date_create;
            //     $arr[$key]['necessity']  = $val->necessity;
            //     $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            //     $arr[$key]['unit']  = $val->unit;
            //     if($val->status == 1){
            //         $na        = DB::table('users')->where('id', $val->id_user)->first();
            //         $text_status    = 'CREATE <br> By <br>'.$na->name;
            //     }elseif($val->status == 2){
            //         $na        = DB::table('users')->where('id', $val->id_dephead)->first();
            //         $text_status    = 'APPROVE DEPHEAD <br> By <br>'.$na->name;
            //     }elseif($val->status == 3){
            //         $na        = DB::table('users')->where('id', $val->id_finance)->first();
            //         $text_status    = 'APPROVE FINANCE <br> By <br>'.$na->name;
            //     }else{
            //         $text_status    = 'Delete';
            //     }
            //     $arr[$key]['status']  = $text_status;
            //     $arr[$key]['modified']  = $val->last_update;
            //     $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            //     $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            //     $arr[$key]['remark']  = $val->remark;
            //     $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="closecia" data-item="'.$val->id.'"><i class="bi bi-check2-square"></i></button>';
            // }

        }

        return response($arr);
    }

    function approvefinancecia(Request $request): object
    {
        $id_user    = auth::user()->id;
        $id         = $request['id'];

        $data   = array(
            'id_finance' => $id_user,
            'status'  => 3,
            'update_by' => $id_user
        );

        DB::table('trx_cia')->where('id', $id)->update($data);
        return response('success');
    }

    function listciacashier()
    {
        $idn_user   = idn_user(auth::user()->id);
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Cash In Advance',
            'idn_user' => $idn_user,
            'role'  => $role
        );

        return view('CashInAdvance.cashier')->with($data);
    }

    function looplistciacashier()
    {
        $dat        = DB::table('trx_cia')->whereIn('status', [3, 5])->get();
        $arr        = [];

        foreach ($dat as $key => $val) {
            $arr[$key]['id']  = $val->id;
            $arr[$key]['no_cia']  = $val->no_cia;
            $requested        = DB::table('users')->where('id', $val->id_user)->first();
            $arr[$key]['requested']  = $requested->name;
            $arr[$key]['create_on']  = $val->date_create;
            $arr[$key]['necessity']  = $val->necessity;
            $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            $arr[$key]['unit']  = $val->unit;
            $text_status    = '';
            if ($val->status == 1) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 2) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Dephead</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 25%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 3) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Finance</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 50%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 4) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 5) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Paid</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 75%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 6) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Settlement</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 7) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="danger" style="font-size: 0.7rem">Oustandaing</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } else {
                // $text_status    = 'Delete';
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            }
            $arr[$key]['status']  = $text_status;
            $arr[$key]['modified']  = $val->last_update;
            $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            $arr[$key]['remark']  = $val->remark;
            if ($val->status == 4) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="upload_bukti_tf" data-item="' . $val->id . '"><i class="bi bi-cash-coin"></i></button>';
            } elseif ($val->status == 5) {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="settlement" data-item="' . $val->id . '"><i class="bi bi-cash-coin"></i></button>';
            } else {
                $arr[$key]['action']  = '<button type="button" class="btn btn-outline-success btn-sm" data-name="approve" data-item="' . $val->id . '"><i class="bi bi-cash-coin"></i></button>';
            }
        }

        return response($arr);
    }

    function submitciaambilchasir(Request $request): object
    {
        $id_user    = auth::user()->id;
        $id         = $request['id_cia'];

        // if($request['metode'] == '1'){
        //     $status = 5;
        // }else{
        //     $status = 4;
        // }

        $data   = array(
            'metode' => $request['metode'],
            'no_rek' => $request['no_rek'],
            'bank' => $request['bank'],
            'atas_nama' => $request['atas_nama'],
            'status'  => 5,
            'id_chasier' => $id_user,
            'update_by' => $id_user
        );

        DB::table('trx_cia')->where('id', $id)->update($data);
        return response('success');
    }

    function listcia()
    {
        $idn_user   = idn_user(auth::user()->id);
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Cash In Advance',
            'idn_user' => $idn_user,
            'role'  => $role
        );

        return view('CashInAdvance.list')->with($data);
    }

    function looplistcia()
    {
        $dat        = DB::table('trx_cia')->where('is_active', 1)->get();
        $arr        = [];

        foreach ($dat as $key => $val) {
            $arr[$key]['id']  = $val->id;
            $arr[$key]['no_cia']  = $val->no_cia;
            $requested        = DB::table('users')->where('id', $val->id_user)->first();
            $arr[$key]['requested']  = $requested->name;
            $arr[$key]['create_on']  = $val->date_create;
            $arr[$key]['necessity']  = $val->necessity;
            $arr[$key]['amount']  = "Rp " . number_format($val->amount, 0, ',', '.');
            $arr[$key]['unit']  = $val->unit;
            $text_status    = '';
            if ($val->status == 1) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 2) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Dephead</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 25%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 3) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Approve Finance</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 50%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 4) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="secondary" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-secondary progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 5) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Paid</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 75%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 6) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Settlement</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 7) {
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="danger" style="font-size: 0.7rem">Oustandaing</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } elseif ($val->status == 8) {
                // $text_status    = 'Delete';
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Finish</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            } else {
                // $text_status    = 'Delete';
                $text_status    .= '<figure class="figure-progress-bar">';
                $text_status    .= '<figcaption class="success" style="font-size: 0.7rem">Draft</figcaption>';
                $text_status    .= '<div class="progress">';
                $text_status    .= '<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"></div>';
                $text_status    .= '</div>';
                $text_status    .= '</figure>';
            }
            $arr[$key]['status']  = $text_status;
            $arr[$key]['status']  = $text_status;
            $arr[$key]['modified']  = $val->last_update;
            $arr[$key]['amount_actual']  = "Rp " . number_format($val->amount_actual, 0, ',', '.');
            $arr[$key]['selisih']  = "Rp " . number_format($val->selisih, 0, ',', '.');
            $arr[$key]['remark']  = $val->remark;
        }

        return response($arr);
    }

    function rejectcia(Request $request): object
    {
        $id     = $request['id'];
        $remark = $request['remark'];

        $data   = array(
            'remark' => $remark,
            'status'  => 0,
            'update_by' => auth::user()->id
        );

        DB::table('trx_cia')->where('id', $id)->update($data);
        return response('success');
    }

    function addamountactual(Request $request): object
    {
        $id             = $request['id'];
        $amount_actual  = $request['amount_actual'];

        $dt             = DB::table('trx_cia')->where('id', $id)->first();
        $selisih        = intval($dt->amount) - intval($amount_actual);

        if ($selisih == 0) {
            $status = 8;
        } else {
            $status = 6;
        }

        $data   = array(
            'amount_actual' => $amount_actual,
            'selisih' => $selisih,
            'status' => $status,
            'update_by' => auth::user()->id
        );

        DB::table('trx_cia')->where('id', $id)->update($data);
        return response('success');
    }

    function submitselisih(Request $request): object
    {
        $id                 = $request['id'];
        $methode_selisih    = $request['methode_selisih'];

        $data   = array(
            'status' => 7,
            'methode_selisih' => $methode_selisih,
            'update_by' => auth::user()->id
        );

        DB::table('trx_cia')->where('id', $id)->update($data);
        return response('success');
    }

    function submitclosecia(Request $request): object
    {
        $id                 = $request['id'];

        $data   = array(
            'status' => 8,
            'update_by' => auth::user()->id
        );

        DB::table('trx_cia')->where('id', $id)->update($data);
        return response('success');
    }

    function downloadcia(Request $request): object
    {
        $date       = $request['date'];
        $status     = $request['status'];

        // if ($status == 'all') {
        //     $arr        = DB::table('trx_cia')->where('date_create', $date)->get();
        // } else {
        //     $arr        = DB::table('trx_cia')->where('date_create', $date)->where('status', $status)->get();
        // }

        // Pisahkan tanggal awal dan akhir jika menggunakan daterangepicker
        $dates = explode(' - ', $date); // Misal: "2024-09-01 - 2024-09-30"
        $startDate = $dates[0];
        $endDate = $dates[1];

        // Query untuk rentang tanggal
        if ($status == 'all') {
            $arr = DB::table('trx_cia')
                ->whereBetween('date_create', [$startDate, $endDate])
                ->get();
        } else {
            $arr = DB::table('trx_cia')
                ->whereBetween('date_create', [$startDate, $endDate])
                ->where('status', $status)
                ->get();
        }


        // Load the template file
        $templatePath = public_path() . '/template/tmp_cia.xlsx';
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Assuming your template has headers in the first row
        $startRow = 2; // Data starts from the second row
        $no       = 1;
        foreach ($arr as $index => $val) {
            $sheet->setCellValue('A' . ($startRow + $index), $no++);
            $sheet->setCellValue('B' . ($startRow + $index), $val->no_cia);
            $requested        = DB::table('users')->where('id', $val->id_user)->first();
            $sheet->setCellValue('C' . ($startRow + $index), $requested->name);
            $sheet->setCellValue('D' . ($startRow + $index), \Carbon\Carbon::parse($val->date_create)->isoFormat('DD MMM YYYY'));
            $sheet->setCellValue('E' . ($startRow + $index), $val->necessity);
            $sheet->setCellValue('F' . ($startRow + $index), $val->amount);
            $sheet->setCellValue('G' . ($startRow + $index), $val->unit);
            if ($val->status == 1) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Draft');
            } elseif ($val->status == 2) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Approve Dephead');
            } elseif ($val->status == 3) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Approve Finance');
            } elseif ($val->status == 4) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Draft');
            } elseif ($val->status == 5) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Paid');
            } elseif ($val->status == 6) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Settlement');
            } elseif ($val->status == 7) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Oustandaing');
            } elseif ($val->status == 0) {
                $sheet->setCellValue('H' . ($startRow + $index), 'Finish');
            } else {
                $sheet->setCellValue('H' . ($startRow + $index), 'Draft');
            }

            $sheet->setCellValue('I' . ($startRow + $index), \Carbon\Carbon::parse($val->last_update)->isoFormat('DD MMM YYYY HH:mm:ss'));
            $sheet->setCellValue('J' . ($startRow + $index), $val->amount_actual);
            $sheet->setCellValue('K' . ($startRow + $index), $val->selisih);
            $reqdep        = DB::table('users')->where('id', $val->id_dephead)->first();
            if ($reqdep) {
                $sheet->setCellValue('L' . ($startRow + $index), $reqdep->name);
            } else {
                $sheet->setCellValue('L' . ($startRow + $index), '-');
            }

            $reqfin        = DB::table('users')->where('id', $val->id_finance)->first();
            if ($reqfin) {
                $sheet->setCellValue('M' . ($startRow + $index), $reqfin->name);
            } else {
                $sheet->setCellValue('M' . ($startRow + $index), '-');
            }
        }

        // Create a file name
        $fileName = 'Report_CIA.xlsx';

        // Create a StreamedResponse to output the Excel file to the browser
        $response = new StreamedResponse(function () use ($spreadsheet, $fileName) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        // Set the headers for the response
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        $response->headers->set('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->headers->set('Cache-Control', 'cache, must-revalidate');
        $response->headers->set('Pragma', 'public');

        return $response;
    }

    // End Cash In Avance

    function test()
    {
        $reqbooking  = '["2024-04-27"]';
        $kategori  = 1;
        $date_start  = '2024-04-27 20:00:00';
        $date_end  = '2024-04-27 23:00:00';
        $arr = testhelper();
        echo '<pre>';
        print_r($arr);
        exit;
    }
}
