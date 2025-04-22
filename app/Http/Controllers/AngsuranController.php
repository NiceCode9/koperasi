<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AngsuranController extends Controller
{
    // Method index() untuk Admin
    public function index(Request $request)
    {
        $query = Angsuran::with('pengajuan.nasabah')
            ->orderBy('tanggal_jatuh_tempo', 'desc');

        // Filter untuk Admin
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_angsuran', 'like', "%$search%")
                    ->orWhereHas('pengajuan.nasabah', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%$search%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_jatuh_tempo', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_jatuh_tempo', '<=', $request->end_date);
        }

        $angsurans = $query->paginate(10)->withQueryString();

        return view('admin.angsuran.index', compact('angsurans'));
    }

    // Method nasabahIndex() untuk Nasabah
    public function nasabahIndex(Request $request)
    {
        $pengajuan = auth()->user()->nasabah->pengajuan()
            ->with(['angsurans' => function ($q) {
                $q->orderBy('tanggal_jatuh_tempo', 'asc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        // if ($request->filled('search')) {
        //     $query->where('nomor_pengajuan', 'like', "%{$request->search}%");
        // }

        // if ($request->filled('tanggal')) {
        //     $query->whereHas('angsurans', function ($q) use ($request) {
        //         $q->whereDate('tanggal_jatuh_tempo', $request->tanggal);
        //     });
        // }

        // $pengajuan = $query->paginate(10)->withQueryString();

        return view('nasabah.angsuran.index', compact('pengajuan'));
    }

    // Form pembayaran angsuran oleh admin
    public function create(Angsuran $angsuran)
    {
        return view('admin.angsuran.create', compact('angsuran'));
    }

    // Proses pembayaran angsuran
    public function store(Request $request, Angsuran $angsuran)
    {
        $request->validate([
            'tanggal_bayar' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isFuture()) {
                        $fail('Tanggal pembayaran tidak boleh lebih dari hari ini!');
                    }
                }
            ],
            'keterangan' => 'nullable|string',
        ]);

        // Hitung keterlambatan otomatis
        $tanggalBayar = Carbon::parse($request->tanggal_bayar);
        $jatuhTempo = Carbon::parse($angsuran->tanggal_jatuh_tempo);
        $hariTerlambat = $tanggalBayar->diffInDays($jatuhTempo, false); // false = hanya hitung jika positif

        $denda = 0;
        $status = 'paid';

        if ($hariTerlambat > 0) {
            // $denda = $hariTerlambat * config('angsuran.denda_per_hari');
            $denda = $hariTerlambat * 10000;
            $status = 'late';

            // Alert otomatis
            Alert::warning('Peringatan', 'Pembayaran terlambat ' . $hariTerlambat . ' hari. Denda: Rp ' . number_format($denda, 0, ',', '.'));
        }

        $angsuran->update([
            'tanggal_bayar' => $tanggalBayar,
            'denda' => $denda,
            'status' => $status,
            'keterangan' => $request->keterangan,
        ]);

        $this->checkPengajuanLunas($angsuran->pengajuan);

        Alert::success('Berhasil', 'Pembayaran berhasil dicatat!');
        return redirect()->route('admin.angsuran.index');
    }

    private function checkPengajuanLunas(Pengajuan $pengajuan)
    {
        $unpaidCount = $pengajuan->angsurans()->where('status', '!=', 'paid')->count();

        if ($unpaidCount === 0) {
            $pengajuan->update([
                'status_pembayaran' => 'lunas',
                'status' => 'lunas' // Jika Anda ingin mengupdate status utama juga
            ]);

            // Anda bisa tambahkan notifikasi ke nasabah di sini
        } else {
            $pengajuan->update([
                'status_pembayaran' => 'belum_lunas'
            ]);
        }
    }
}
