<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
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

class DocumentController extends Controller
{
    public function create()
    {
        // Bagian yang Anda inginkan agar tetap utuh di controller
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users WHERE is_active = 1");
        $role       = DB::select("SELECT * FROM mst_role WHERE is_active = 1");

        // Mengambil data dokumen dari tabel trx_file
        $documents = DB::select("SELECT * FROM trx_file WHERE is_active = 1");

        // Menyusun data untuk view
        $data = array(
            'title' => 'Form Entri Dokumen',
            'arr' => $arr,
            'idn_user' => $idn_user,
            'role' => $role,
            'documents' => $documents // Menambahkan data dokumen ke array
        );

        return view('Document.create')->with($data);
    }
    public function upload(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2048',  // Maksimal 2MB
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'to_dept' => 'required|string|max:255',
            'ukuran_file' => 'required|string|max:50', // Jika menggunakan VARCHAR
        ]);

        // Jika validasi gagal, kembalikan dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mengambil file dari request
        $file = $request->file('file');

        // Memastikan file valid
        if ($file && $file->isValid()) {
            // Membuat nama file unik
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path('assets/docu/');

            // Membuat folder jika belum ada
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            // Memindahkan file ke path yang ditentukan
            $file->move($path, $fileName);

            // Mendapatkan ukuran file dari input
            $ukuranFile = $request->input('ukuran_file'); // Mengambil ukuran yang sudah diisi

            // Simpan informasi file ke database
            DB::table('trx_file')->insert([
                'title' => $request->title,
                'file_name' => 'assets/docu/' . $fileName, // Path relatif untuk file
                'ukuran_file' => $ukuranFile, // Menyimpan ukuran sebagai VARCHAR
                'category' => $request->category,
                'from_departement' => Auth::user()->department,
                'role_id' => Auth::user()->role_id,
                'to_dept' => $request->to_dept,
                'status' => 'Pending', // Status awal
                'is_active' => 1, // Aktif
                'tahap' => 'Sechead', // Tahap awal
            ]);

            // Redirect kembali ke form create dengan pesan sukses
            return redirect()->route('document.create')->with('success', 'File berhasil di-upload dan menunggu approval Sechead.');
        } else {
            return redirect()->back()->with('error', 'Gagal meng-upload file.')->withInput();
        }
    }

    // Approve Sechead
    public function approveSechead($id)
    {
        DB::update("UPDATE trx_file SET status = 'Approved Sechead', tahap = 'Dephead' WHERE id = ?", [$id]);
        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil disetujui oleh Sechead dan menunggu approval Dephead.');
    }

    // Approve Dephead
    public function approveDephead($id)
    {
        DB::update("UPDATE trx_file SET status = 'Approved Dephead', tahap = 'PIC' WHERE id = ?", [$id]);
        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil disetujui oleh Dephead dan menunggu penempatan oleh PIC Document.');
    }

    // PIC Document
    public function picDocu(Request $request, $id)
    {
        // Logika untuk penempatan file oleh PIC Document
        // Misalnya menggerakkan file ke folder yang ditentukan
        DB::update("UPDATE trx_file SET status = 'Completed', tahap = 'Completed' WHERE id = ?", [$id]);
        // Logika untuk mengatur file di folder
        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil dipindahkan dan ditempatkan oleh PIC Document.');
    }

    public function approve($id)
    {
        // Mengubah status dokumen setelah disetujui
        DB::update("UPDATE trx_file SET status = 'Approved' WHERE id = ?", [$id]);
        return redirect()->back()->with('success', 'Dokumen berhasil disetujui.');
    }
}
