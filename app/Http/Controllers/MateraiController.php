MateraiControler
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
    function indexFinance()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        $stok_saat_ini = $this->getLatestStok();  // Mendapatkan stok saat ini

        // Mengambil transaksi yang dilakukan oleh finance
        $stok = DB::table('trx_stok')
            ->join('users', 'trx_stok.user_fin', '=', 'users.id')
            ->select('trx_stok.*', 'users.name as finance_name')
            ->orderBy('trx_stok.created_at', 'asc')
            ->get();

        // Mengambil transaksi materai yang dilakukan oleh requester
        $materai = DB::table('trx_materai')
            ->join('users', 'trx_materai.user_req', '=', 'users.id')
            ->select('trx_materai.*', 'users.name as requester_name')
            ->orderBy('trx_materai.created_at', 'asc')
            ->get();

        // Mulai menghitung balance dari stok awal
        $balance = 0;
        $transaction_history = [];

        // Memproses penambahan stok oleh finance
        foreach ($stok as $transaksi_stok) {
            $add = $transaksi_stok->jumlah_stok;
            $balance += $add;

            // Menyimpan ke dalam riwayat transaksi
            $transaction_history[] = [
                'id' => $transaksi_stok->id,
                'employee' => $transaksi_stok->finance_name,
                'add' => $add,
                'minus' => 0,
                'return' => 0,
                'balance' => $balance,
                'date' => $transaksi_stok->created_at
            ];
        }

        // Memproses pengambilan dan pengembalian stok oleh requester
        foreach ($materai as $transaksi_materai) {
            $minus = $transaksi_materai->jumlah_ambil;
            $return = $transaksi_materai->jumlah_kembali;

            // Jika ada pengambilan, kurangi balance
            if ($minus > 0) {
                $balance -= $minus;
            }

            // Jika ada pengembalian, tambahkan kembali ke balance
            if ($return > 0) {
                $balance += $return;
            }

            // Simpan hasil perhitungan ke riwayat transaksi
            $transaction_history[] = [
                'id' => $transaksi_materai->id,
                'employee' => $transaksi_materai->requester_name,
                'add' => 0,
                'minus' => $minus,
                'return' => $return,
                'balance' => $balance,
                'date' => $transaksi_materai->created_at
            ];
        }

        $data = [
            'title' => 'Users',
            'arr' => $arr,
            'idn_user' => $idn_user,
            'stok' => $stok,
            'stok_saat_ini' => $stok_saat_ini,
            'balance' => $balance,
            'role' => $role,
            'materai' => $materai,
            'transaction_history' => $transaction_history
        ];

        return view('materai.finance', compact('stok_saat_ini', 'stok', 'balance', 'transaction_history'))->with($data);
    }

    function indexRequester()
    {
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $role       = DB::select("SELECT * FROM mst_role where is_active=1");
        // Ambil histori transaksi materai dari tabel trx_materai dan join dengan tabel users
        $materai = DB::table('trx_materai')
            ->join('users', 'trx_materai.user_req', '=', 'users.id')
            ->select('trx_materai.*', 'users.name as requester_name')
            ->orderBy('trx_materai.created_at', 'asc')
            ->get();

        // Ambil stok materai saat ini
        $stok_saat_ini = $this->getLatestStok();

        // Buat array data untuk dikirim ke view
        $data = [
            'title' => 'Users',
            'arr' => $arr,
            'idn_user' => $idn_user,
            'role' => $role,
            'materai' => $materai, // Masukkan data materai ke dalam array data
            'stok_saat_ini' => $stok_saat_ini // Masukkan data stok ke dalam array data
        ];

        // Return view 'materai.requester' dengan data
        return view('Materai.requester', $data);
    }

    public function updateStok(Request $request)
    {
        // Validasi input
        $request->validate([
            'jumlah_stok' => 'required|integer|min:1',
        ], [
            'jumlah_stok.required' => 'Jumlah stok harus diisi.',
            'jumlah_stok.integer' => 'Jumlah stok harus berupa angka.',
            'jumlah_stok.min' => 'Jumlah stok minimal harus 1.'
        ]);

        // Ambil stok saat ini
        $stok_saat_ini = $this->getLatestStok();

        // Kalkulasi stok baru
        $stok_baru = $stok_saat_ini + $request->jumlah_stok;

        DB::table('trx_stok')->insert([
            'user_fin' => auth()->user()->id,
            'jumlah_stok' => $stok_baru,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('materai.finance')->with('success', 'Stok berhasil Diperbarui. Stok saat ini: ' . $stok_baru);
    }


    private function getLatestStok()
    {
        // Ambil jumlah stok terbaru berdasarkan created_at terbaru
        $stok_saat_ini = DB::table('trx_stok')->orderBy('created_at', 'desc')->value('jumlah_stok');

        // Jika tidak ada stok, set default 0
        return $stok_saat_ini ?? 0;
    }


    public function ambilMaterai(Request $request)
    {
        $request->validate([
            'jumlah_ambil' => 'required|integer|min:1',
            'keterangan' => 'required|string',
        ], [
            'jumlah_ambil.required' => 'Jumlah materai yang ingin diambil harus diisi.',
            'jumlah_ambil.integer' => 'Jumlah materai harus berupa angka.',
            'jumlah_ambil.min' => 'Jumlah materai minimal 1.',
            'keterangan.required' => 'Keterangan harus diisi.'
        ]);

        DB::beginTransaction();

        try {
            $stok_saat_ini = $this->getLatestStok();
            if ($stok_saat_ini < $request->jumlah_ambil) {
                throw new \Exception('Stok tidak mencukupi untuk pengambilan');
            }

            $stok_baru = $stok_saat_ini - $request->jumlah_ambil;

            DB::table('trx_materai')->insert([
                'user_req' => auth()->user()->id,
                'keterangan' => $request->keterangan,
                'jumlah_ambil' => $request->jumlah_ambil,
                'jumlah_kembali' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update stok setelah pengambilan
            DB::table('trx_stok')->insert([
                'user_fin' => auth()->user()->id,
                'jumlah_stok' => $stok_baru,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect()->route('materai.requester')->with('success', 'Materai berhasil diambil. Stok tersisa: ' . $stok_baru);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('materai.requester')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function kembalikanMaterai(Request $request, $id)
    {
        // Ambil data materai berdasarkan id
        $materai = DB::table('trx_materai')->where('id', $id)->first();

        if ($materai) {
            // Ambil jumlah kembali dari input
            $jumlahKembali = $request->input('jumlah_kembali');

            // Update jumlah kembali di trx_materai
            DB::table('trx_materai')->where('id', $id)->update([
                'jumlah_kembali' => $materai->jumlah_kembali + $jumlahKembali,
                'updated_at' => now(),
            ]);

            // Update stok di trx_stok dengan menambahkan jumlah_kembali
            $stokExisting = DB::table('trx_stok')->orderBy('created_at', 'desc')->first();

            if ($stokExisting) {
                DB::table('trx_stok')->where('id', $stokExisting->id)->increment('jumlah_stok', $jumlahKembali);
            } else {
                // Jika stok tidak ditemukan, tambahkan stok baru
                DB::table('trx_stok')->insert([
                    'user_fin' => auth::user()->id, // Pastikan ada user finance yang terkait
                    'jumlah_stok' => $jumlahKembali,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->route('materai.requester')->with('success', 'Materai berhasil dikembalikan dan stok telah diperbarui.');
        }

        return redirect()->route('materai.requester')->with('error', 'Terjadi kesalahan. Data materai tidak ditemukan.');
    }


    public function getHistori()
    {
        $histori = DB::table('trx_materai')
            ->join('users', 'trx_materai.user_req', '=', 'users.id')
            ->select('trx_materai.*', 'users.name as requester_name')
            ->orderBy('trx_materai.created_at', 'desc')
            ->get();

        return response()->json($histori);
    }
}
