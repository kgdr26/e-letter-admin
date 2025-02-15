<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
use Carbon\Carbon;
use App\Models\user;
use Auth;
use Hash;
use Redirect;
use DB;
use PDF;

class ControllerCIA extends Controller
{
    public function indexForm()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr = DB::select("SELECT * FROM users WHERE is_active=1");
        $role = DB::select("SELECT * FROM mst_role WHERE is_active=1");

        // Menampilkan list Cash In Advance dari user yang sedang login
        // $cia_list = DB::table('trx_cia')
        //     ->where('id_user', $idn_user->id)
        //     ->orderBy('last_update', 'desc')
        //     ->get();

        // Menampilkan list Cash In Advance yang hanya aktif (is_active = 1)
        $cia_list = DB::table('trx_cia')
            ->leftJoin('users', 'trx_cia.id_user', '=', 'users.id')
            ->where('trx_cia.is_active', 1) // Hanya menampilkan data yang aktif
            ->orderBy('last_update', 'desc')
            ->select('trx_cia.*', 'users.name as user_name')
            ->get();
        $data = [
            'title' => 'Form Cash In Advance',
            'idn_user' => $idn_user,
            'role' => $role,
            'arr' => $arr,
            'cia_list' => $cia_list // List CIA untuk card di sisi kanan
        ];
        return view('CashInAdvance.form_cia')->with($data);  // Update path view
    }




    // Method untuk menyimpan pengajuan CIA
    public function store(Request $request)
    {
        $id_user = auth()->user()->id;

        // Generate nomor CIA otomatis
        $bulanTahun = date('Ym');
        $lastCia = DB::table('trx_cia')->orderBy('id', 'desc')->first();
        $lastNoCia = $lastCia ? $lastCia->no_cia : null;

        if ($lastNoCia) {
            $lastSequence = (int)substr($lastNoCia, -3);
            $newSequence = str_pad($lastSequence + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newSequence = '001';
        }

        $no_cia = 'CIA/' . $bulanTahun . '/A' . $newSequence;

        // Menghapus 'Rp' dan titik sebelum konversi ke integer
        $amount = str_replace(['Rp ', '.'], '', $request->amount);
        $amount = (int)$amount; // Mengonversi ke integer


        // Simpan data ke tabel trx_cia
        DB::table('trx_cia')->insert([
            'id_user'   => $id_user,
            'no_cia'    => $no_cia,
            'date_create' => $request->date_create,
            'necessity' => $request->necessity,
            'amount'    => $amount,
            'qty'       => $request->qty,
            'unit'      => $request->unit,
            'remark'    => null,
            'status'    => 1, // Status 1: Draft
            'is_active' => 1,
            'update_by' => $id_user,
            'last_update' => now()
        ]);

        return redirect()->route('cia.form')->with('success', 'Cash In Advance submitted successfully!');
    }



    public function printPdf($id)
    {
        // Ambil data berdasarkan ID
        // Mengambil data CIA dengan leftJoin ke tabel users untuk mendapatkan user_name
        $cia = DB::table('trx_cia')
            ->leftJoin('users', 'trx_cia.id_user', '=', 'users.id')
            ->where('trx_cia.id', $id)
            ->select('trx_cia.*', 'users.name as user_name') // Memilih kolom yang dibutuhkan
            ->first();

        if (!$cia) {
            return redirect()->route('cia.form')->with('error', 'Cash In Advance not found!');
        }

        // Load view untuk PDF
        $pdf = PDF::loadView('CashInAdvance.pdf_template', compact('cia'));
        // Ambil no_cia sebagai nama file
        $fileName =
            'ADS-' . preg_replace('/[\/\\\\]/', '-', $cia->no_cia) . '.pdf';
        // Stream atau download file PDF
        return $pdf->download($fileName);
    }

    public function updateStatus($ciaId, $newStatus)
    {
        $cia = DB::table('trx_cia')->where('id', $ciaId)->first();

        // Cek status saat ini dan update sesuai dengan flow yang Anda jelaskan
        switch ($newStatus) {
            case 2: // Approved Dephead
                if ($cia->status == 1) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 2,
                        'last_update' => now()
                    ]);
                }
                break;

            case 3: // Approved Finance
                if ($cia->status == 2) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 3,
                        'last_update' => now()
                    ]);
                }
                break;

            case 4: // Proses Pre-paid
                if ($cia->status == 3) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 4,
                        'last_update' => now()
                    ]);
                }
                break;

            case 5: // Paid
                if ($cia->status == 4) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 5,
                        'last_update' => now()
                    ]);
                }
                break;

            case 6: // Going Settlement
                if ($cia->status == 5) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 6,
                        'last_update' => now()
                    ]);
                }
                break;

            case 7: // Approved Settlement
                if ($cia->status == 6) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 7,
                        'last_update' => now()
                    ]);
                }
                break;

            case 8: // Proses Settlement
                if ($cia->status == 7) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 8,
                        'last_update' => now()
                    ]);
                }
                break;

            case 9: // Settlement Paid
                if ($cia->status == 8) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 9,
                        'last_update' => now()
                    ]);
                }
                break;

            case 10: // Finished CIA
                if ($cia->status == 9) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 10,
                        'last_update' => now()
                    ]);
                }
                break;

            case 11: // Finished CIA
                if ($cia->status == 10) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 10,
                        'last_update' => now()
                    ]);
                }
                break;

            case 12: // Outstanding
                if ($cia->status < 11) {
                    DB::table('trx_cia')->where('id', $ciaId)->update([
                        'status' => 11,
                        'remark' => 'Urgent',
                        'last_update' => now()
                    ]);
                }
                break;
        }

        return redirect()->route('cia.form')->with('success', 'Status updated successfully!');
    }





    public function edit(Request $request)
    {
        // Mengambil ID dari request
        $id = $request->input('id');

        // Mengambil data CIA berdasarkan ID
        $cia = DB::table('trx_cia')->where('id', $id)->first();

        // Cek apakah data ditemukan
        if (!$cia) {
            return response()->json(['error' => 'Cash In Advance not found!'], 404);
        }

        // Kembalikan data dalam bentuk JSON
        return response()->json(['data' => $cia]);
    }
    public function update(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'necessity' => 'required',
            'amount' => 'required|numeric',
            'qty' => 'required|numeric',
            'unit' => 'required'
        ]);

        // Mengambil ID dari request
        $id = $request->input('id');

        // Proses update ke database
        $updated = DB::table('trx_cia')->where('id', $id)->update([
            'necessity' => $request->input('necessity'),
            'amount' => str_replace(',', '', $request->input('amount')), // Menghilangkan format ribuan jika ada
            'qty' => $request->input('qty'),
            'unit' => $request->input('unit'),
            'last_update' => now(), // Menyimpan waktu update terakhir
        ]);

        if ($updated) {
            // Jika update berhasil
            return response()->json(['success' => 'Cash In Advance updated successfully!']);
        } else {
            // Jika tidak ada baris yang di-update
            return response()->json(['error' => 'No data was updated'], 500);
        }
    }

    public function depheadApproval()
    {
        $idn_user = auth()->user();
        $arr = DB::select("SELECT * FROM users WHERE is_active=1");
        $role = DB::select("SELECT * FROM mst_role WHERE is_active=1");
        $cia_list = DB::table('trx_cia')
            ->leftJoin('users', 'trx_cia.id_user', '=', 'users.id')
            ->where('trx_cia.is_active', 1) // Hanya menampilkan data yang aktif
            ->orderBy('last_update', 'desc')
            ->select('trx_cia.*', 'users.name as user_name')
            ->get();
        $data = [
            'title' => 'Form Cash In Advance',
            'idn_user' => $idn_user,
            'role' => $role,
            'arr' => $arr,
            'cia_list' => $cia_list // List CIA untuk card di sisi kanan
        ];

        // return view('CashInAdvance.form_cia')->with($data);
        return view('CashInAdvance.depheadApproval', ['data' => $cia_list])->with($data);
    }

    public function depheadApproveOrReject(Request $request)
    {
        $cia_id = $request->input('cia_id');
        $action = $request->input('action');

        if ($action == 'approve') {
            // Update status to "approved by Dephead" (status = 2)
            DB::table('trx_cia')->where('id', $cia_id)->update([
                'status' => 2, // Status 2 = Approved by Dephead
                'remark' => null
            ]);
            return redirect()->back()->with('success', 'CIA approved successfully.');
        } elseif ($action == 'reject') {
            // Validate rejection reason
            $request->validate([
                'rejection_reason' => 'required|string|max:255',
            ]);

            // Update status to "rejected by Dephead" (status = 3) and set rejection reason in 'remark'
            $rejection_reason = $request->input('rejection_reason');
            DB::table('trx_cia')->where('id', $cia_id)->update([
                'status' => 10, // Status 3 = Rejected by Dephead
                'remark' => $rejection_reason
            ]);

            return redirect()->back()->with('success', 'CIA rejected successfully.');
        }

        return redirect()->back()->with('error', 'Invalid action.');
    }

    public function financeApproval()
    {
        $data = DB::select("SELECT * FROM trx_cia WHERE status = 'approved by dephead' AND id_finance = ?", [auth()->user()->role_id]);
        return view('CashInAdvance.financeApproval', ['data' => $data]);
    }

    public function paymentRequest()
    {
        $data = DB::select("SELECT * FROM trx_cia WHERE status = 'approved by finance'");
        return view('CashInAdvance.paymentRequest', ['data' => $data]);
    }

    public function submitSettlement(Request $request)
    {
        $cia_id = $request->input('cia_id');
        $amount_actual = (float)str_replace(',', '', $request->input('amount_actual'));
        $remark = $request->input('remark');

        $cia = DB::table('trx_cia')->where('id', $cia_id)->first();
        $amount_initial = (float)$cia->amount;

        // Menghitung selisih (jika ada)
        $difference = $amount_initial - $amount_actual;

        DB::update(
            "UPDATE trx_cia SET amount_actual = ?, remark = ?, difference = ?, status = 7, last_update = now() WHERE id = ?",
            [$amount_actual, $remark, $difference, $cia_id]
        );

        return redirect()->route('cia.paymentRequest')->with('success', 'Settlement submitted successfully!');
    }

    // Method untuk menampilkan overview CIA
    public function overview()
    {
        $cia_list = DB::table('trx_cia')->orderBy('last_update', 'desc')->get();
        return view('CashInAdvance.overview', ['cia_list' => $cia_list]);
    }

    public function delete($id)
    {
        // Cek apakah data ada
        $cia = DB::table('trx_cia')->where('id', $id)->first();

        if (!$cia) {
            return redirect()->route('cia.form')->with('error', 'Cash In Advance not found!');
        }

        // Ubah status is_active menjadi 0, artinya data sudah "dihapus"
        DB::table('trx_cia')->where('id', $id)->update(['is_active' => 0]);

        return redirect()->route('cia.form')->with('success', 'Cash In Advance deleted successfully!');
    }
}
