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
use App\Models\Materai;
use Auth;
use Hash;
use Redirect;
use DB;

class MateraiController extends Controller
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

        return view('materai.create')->with($data);
    }
    public function index()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $arr2        = DB::select("SELECT * FROM materai where jumlah");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Users',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role,
            'arr2' => $arr2
        );
        $stok = Materai::sum('jumlah');
        return view('materai.index', compact('stok'))->with($data);
    }

    public function create()
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
        return view('materai.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'jenis' => 'required|in:masuk,keluar',
            'keterangan' => 'nullable|string',
        ]);

        $jumlah = $request->jenis == 'keluar' ? -$request->jumlah : $request->jumlah;

        Materai::create([
            'jumlah' => $jumlah,
            'jenis' => $request->jenis,
            'keterangan' => $request->keterangan,
            'user' => Auth::user()->name,
        ]);

        return redirect()->route('materai.index')->with('success', 'Data berhasil disimpan');
    }

    public function history()
    {
        $history = Materai::orderBy('created_at', 'desc')->get();
        return view('materai.history', compact('history'));
    }

    public function export()
    {
        $materai = Materai::all();

        // Logic untuk export ke Excel
        // (Anda perlu mengimplementasikan ini sesuai kebutuhan)

        return response()->download($filePath);
    }
}
