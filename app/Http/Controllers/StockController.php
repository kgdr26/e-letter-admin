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

class StockController extends Controller
{
    public function index()
    {
        // Otorisasi pengguna login
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");

        // Ambil data user berdasarkan ID untuk mendapatkan nama
        $currentUser = DB::table('users')->where('id', auth()->user()->id)->first();

        // Ambil nama user dari tabel users
        $userName = $currentUser ? $currentUser->name : 'Unknown User';


        // $history = DB::table('trx_stok')->orderBy('created_at', 'asc')->get();
        // Query data stok dengan menggabungkan tabel users untuk mendapatkan nama user
        $history = DB::table('trx_stok')
            ->leftJoin('users as finance', 'trx_stok.user_finance', '=', 'finance.id')
            ->leftJoin('users as requester', 'trx_stok.user_requester', '=', 'requester.id')
            ->select(
                'trx_stok.*',
                'finance.name as finance_name',
                'requester.name as requester_name'
            )
            ->orderBy('trx_stok.created_at', 'asc')
            ->get();

        // Hitung total stok yang sudah di-entry
        $total_stok_entry = DB::table('trx_stok')->sum('jumlah_stok');
        // Hitung total stok yang sudah diambil
        $total_stok_taken = DB::table('trx_stok')->sum('jumlah_ambil');
        // Hitung total stok yang dikembalikan
        $total_stok_returned = DB::table('trx_stok')->sum('jumlah_kembali');

        // Formula balancing stock
        $total_stok = $total_stok_entry - $total_stok_taken + $total_stok_returned;

        $data = array(
            'title'     => 'Users',
            'arr'       => $arr,
            'idn_user'  => $idn_user,
            'role'      => $role,
            'total_stok' => $total_stok, // kirim ke view
            'history'   => $history
        );

        // Data untuk dikirim ke view
        $data = array(
            'title'     => 'Users',
            'arr'       => DB::select("SELECT * FROM users where is_active=1"),
            'idn_user'  => $idn_user,
            'role'      => DB::select("SELECT * FROM mst_role where is_active=1"),
            'total_stok' => $total_stok, // kirim ke view
            'history'   => $history,
            'userName'  => $userName // kirim nama user ke view
        );

        return view('stok.index', compact('total_stok', 'history'))->with($data);
    }

    public function addStock(Request $request)
    {
        // Otorisasi pengguna login
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Users',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );

        // Validasi form input
        $request->validate([
            'jumlah_stok' => 'required|integer|min:1',
        ]);

        // Entry stok baru oleh user finance
        DB::table('trx_stok')->insert([
            'user_finance' => auth::user()->id,
            'jumlah_stok' => $request->input('jumlah_stok')
        ]);

        // Redirect ke halaman stok.index dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambahkan.')->with($data);
    }

    public function minusReturnStock(Request $request)
    {
        // Otorisasi pengguna login
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $data = array(
            'title' => 'Users',
            'arr'   => $arr,
            'idn_user' => $idn_user,
            'role'  => $role
        );

        // Hitung total stok yang ada
        $total_stok_entry = DB::table('trx_stok')->sum('jumlah_stok');
        $total_stok_taken = DB::table('trx_stok')->sum('jumlah_ambil');
        $total_stok_returned = DB::table('trx_stok')->sum('jumlah_kembali');
        $total_stok = $total_stok_entry - $total_stok_taken + $total_stok_returned;

        // Validasi jika stok tidak cukup untuk diambil
        if ($request->jumlah_ambil > $total_stok) {
            return redirect()->route('stok.index')->with('error', 'Sorry Gaes...Stok tidak mencukupi.');
        }

        // Proses pengambilan atau pengembalian
        DB::table('trx_stok')->insert([
            'user_requester' => auth()->user()->id,
            'jumlah_ambil'   => $request->jumlah_ambil ?? 0,
            'jumlah_kembali' => $request->jumlah_kembali ?? 0,
            'keterangan'     => $request->keterangan
        ]);

        return redirect()->route('stok.index')->with('success', 'Transaksi Berhasil, Ternyata Kamu Jagooo..!!.')->with($data);
    }


    public function exportStockHistoryToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $headers = [
            'No',
            'Employee',
            'Add',
            'Minus',
            'Return',
            'Note',
            'Balancing',
            'Date'
        ];
        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            $column++;
        }

        // Fetch the data
        $history = DB::table('trx_stok')
            ->leftJoin('users as finance', 'trx_stok.user_finance', '=', 'finance.id')
            ->leftJoin('users as requester', 'trx_stok.user_requester', '=', 'requester.id')
            ->select(
                'trx_stok.*',
                'finance.name as finance_name',
                'requester.name as requester_name'
            )
            ->orderBy('trx_stok.created_at', 'asc')
            ->get();

        // Fill the data
        $row = 2;
        $remainingStock = 0;
        foreach ($history as $index => $entry) {
            $remainingStock += $entry->jumlah_stok - $entry->jumlah_ambil + $entry->jumlah_kembali;

            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $entry->finance_name ?? $entry->requester_name ?? 'Unknown User');
            $sheet->setCellValue('C' . $row, $entry->jumlah_stok);
            $sheet->setCellValue('D' . $row, $entry->jumlah_ambil);
            $sheet->setCellValue('E' . $row, $entry->jumlah_kembali);
            $sheet->setCellValue('F' . $row, $entry->keterangan);
            $sheet->setCellValue('G' . $row, $remainingStock);
            $sheet->setCellValue('H' . $row, $entry->created_at);

            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'stock_history_' . date('Y-m-d') . '.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Output the file to the browser
        $writer->save('php://output');
        exit;
    }
}
