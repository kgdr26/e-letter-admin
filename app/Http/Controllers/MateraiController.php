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

class MateraiController extends Controller
{

    // Menampilkan form input stok material
    public function createStock()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Form Stock Materai || Finance',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );
        $transactions = DB::table('transactions')->get();
        return view('Materai.createStock', compact('transactions'))->with($data);
    }

    // Menyimpan data stok material
    public function storeStock(Request $request)
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Form Stock Materai || Finance',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );
        $request->validate([
            'stock' => 'required|integer|min:1',
        ]);

        DB::table('materais')->insert([
            'name' => 'Materai', // Nama bisa disesuaikan
            'stock' => $request->stock,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('stock.create')->with(
            'success',
            'Stok berhasil ditambahkan.'
        );
    }

    // Menampilkan form untuk pengambilan atau pengembalian materai
    public function createTransaction()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Form Stock Materai || Finance',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );
        $materai = DB::table('materais')->first(); // Ambil data stok materai
        return view('Materai.createTransaction', compact('materai'))->with($data);
    }

    // Menyimpan transaksi pengambilan atau pengembalian
    public function storeTransaction(Request $request)
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Form Stock Materai || Finance',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );
        $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil stok materai terkini
        $materai = DB::table('materais')->first();

        if ($request->type === 'out' && $materai->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Simpan transaksi
        DB::table('transactions')->insert([
            'materai_id' => $materai->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update stok
        if ($request->type === 'out') {
            DB::table('materais')->where('id', $materai->id)->decrement('stock', $request->quantity);
        } else {
            DB::table('materais')->where('id', $materai->id)->increment('stock', $request->quantity);
        }

        return redirect()->route('transaction.create')->with('success', 'Transaksi berhasil dicatat.');
    }

    // Menampilkan riwayat transaksi
    public function history()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Form Stock Materai || Finance',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );
        $transactions = DB::table('transactions')->get();
        return view('Materai.history', compact('transactions'))->with($data);
    }
}
