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

    public function createStock()
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

        $materais = DB::table('trx_materais')->get();
        $totalStock = DB::table('trx_materais')->sum('stock');
        $transactions = DB::table('trx_transactions')->orderBy('created_at', 'desc')->get();

        return view('Materai.createStock', compact('materais', 'totalStock', 'transactions'))->with($data);

        // $transactions = DB::table('trx_transactions')->orderBy('created_at', 'desc')->get();
        // $currentStock = DB::table('trx_materais')->value('stock') ?? 0;

        // return view('Materai.createStock', compact('transactions', 'currentStock'))->with($data);

        // $transactions = DB::table('trx_materais')->get();
        // return view('Materai.createStock', compact('transactions'))->with($data);
    }

    public function storeStock(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
        ]);
        // DB::table('trx_materais')->update([
        //     'stock' => DB::raw('stock + ' . $request->stock)
        // ]);

        // DB::table('trx_materais')->updateOrInsert(
        //     ['id' => 1],
        //     ['stock' => DB::raw('stock + ' . $request->stock)]
        // );

        // DB::table('trx_transactions')->insert([
        //     'materai_id' => 1,
        //     'keterangan' => 'Penambahan Stok',
        //     'quantity' => $request->stock,
        //     'employee' => Auth::user()->name,
        //     'status' => 'Tambah Stok',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        DB::table('trx_materais')->insert([
            'name' => $request->name,
            'stock' => $request->stock,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('materaicreate')->with('success', 'Stok materai berhasil ditambahkan.');
    }

    public function createTransaction()
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


        $currentStock = DB::table('trx_materais')->value('stock') ?? 0;
        return view('Materai.createTransaction', compact('currentStock'))->with($data);
        // $materai = DB::table('trx_materais')->first();

        // if (!$materai) {
        //     $stock = 0;
        // } else {
        //     $stock = $materai->stock;
        // }
        // dd($stock);
        // return view('Materai.createTransaction', compact('stock'))->with($data);

    }

    public function storeTransaction(Request $request)
    {
        // $request->validate([
        //     'keterangan' => 'required|string|max:255',
        //     'quantity' => 'required|integer',
        //     'employee' => 'required|string|max:255',
        //     'status' => 'required|string|max:255',
        // ]);

        // if ($request->status == 'Ambil Materai') {
        //     DB::table('trx_materais')->decrement('stock', $request->quantity);
        // } else if ($request->status == 'Kembalikan Materai') {
        //     DB::table('trx_materais')->increment('stock', $request->quantity);
        // }

        // // Simpan transaksi ke tabel trx_transactions
        // DB::table('trx_transactions')->insert([
        //     'materai_id' => 1,
        //     'keterangan' => $request->keterangan,
        //     'quantity' => $request->quantity,
        //     'employee' => $request->employee,
        //     'status' => $request->status,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // kedua
        // $request->validate([
        //     'keterangan' => 'required|string|max:255',
        //     'quantity' => 'required|integer|min:1',
        //     'employee' => 'required|string|max:255',
        //     'status' => 'required|in:Ambil Materai,Kembalikan Materai',
        // ]);

        // $currentStock = DB::table('trx_materais')->value('stock') ?? 0;

        // if ($request->status == 'Ambil Materai' && $currentStock < $request->quantity) {
        //     return redirect()->back()->with('error', 'Stok materai tidak mencukupi.');
        // }

        // DB::transaction(function () use ($request) {
        //     if ($request->status == 'Ambil Materai') {
        //         DB::table('trx_materais')->decrement('stock', $request->quantity);
        //     } else {
        //         DB::table('trx_materais')->increment('stock', $request->quantity);
        //     }

        //     DB::table('trx_transactions')->insert([
        //         'materai_id' => 1,
        //         'keterangan' => $request->keterangan,
        //         'quantity' => $request->quantity,
        //         'employee' => $request->employee,
        //         'status' => $request->status,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        // });
        // end kedua

        $request->validate([
            'materai_id' => 'required|exists:trx_materais,id',
            'keterangan' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'employee' => 'required|string|max:255',
            'status' => 'required|in:Ambil Materai,Kembalikan Materai',
        ]);

        $materai = DB::table('trx_materais')->where('id', $request->materai_id)->first();

        if ($request->status == 'Ambil Materai' && $materai->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok materai tidak mencukupi.');
        }

        DB::transaction(function () use ($request, $materai) {
            if ($request->status == 'Ambil Materai') {
                DB::table('trx_materais')
                    ->where('id', $request->materai_id)
                    ->decrement('stock', $request->quantity);
            } else {
                DB::table('trx_materais')
                    ->where('id', $request->materai_id)
                    ->increment('stock', $request->quantity);
            }

            DB::table('trx_transactions')->insert([
                'materai_id' => $request->materai_id,
                'keterangan' => $request->keterangan,
                'quantity' => $request->quantity,
                'employee' => $request->employee,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });

        return redirect()->route('materaicreate')->with('success', 'Transaksi berhasil disimpan.');
    }
}
