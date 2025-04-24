<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Angsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'manajer') {
            return $this->adminDashboard();
        } elseif ($user->role === 'nasabah') {
            return $this->nasabahDashboard();
        }

        return view('dashboard.dashboard');
    }

    protected function adminDashboard()
    {
        $stats = [
            'total_pengajuan' => Pengajuan::count(),
            'pengajuan_baru' => Pengajuan::where('status', 'survei')->count(),
            'pengajuan_disetujui' => Pengajuan::where('status', 'approved')->count(),
            'pengajuan_ditolak' => Pengajuan::where('status', 'rejected')->count(),
            'angsuran_terlambat' => Angsuran::where('status', 'late')->count(),
        ];

        $recentPengajuan = Pengajuan::with('nasabah')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentAngsuran = Angsuran::with('pengajuan.nasabah')
            ->where('status', 'paid')
            ->orderBy('tanggal_bayar', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentPengajuan', 'recentAngsuran'));
    }

    protected function nasabahDashboard()
    {
        $nasabah = Auth::user()->nasabah;

        if (!$nasabah) {
            return redirect()->route('nasabah.profile')->with('warning', 'Lengkapi profil nasabah terlebih dahulu');
        }

        $stats = [
            'total_pengajuan' => $nasabah->pengajuan()->count(),
            'pengajuan_aktif' => $nasabah->pengajuan()->where('status_pembayaran', 'belum_lunas')->count(),
            'pengajuan_lunas' => $nasabah->pengajuan()->where('status_pembayaran', 'lunas')->count(),
            'angsuran_terlambat' => Angsuran::whereHas('pengajuan', function ($q) use ($nasabah) {
                $q->where('nasabah_id', $nasabah->id);
            })->where('status', 'late')->count(),
        ];

        $recentPengajuan = $nasabah->pengajuan()
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $upcomingAngsuran = Angsuran::whereHas('pengajuan', function ($q) use ($nasabah) {
            $q->where('nasabah_id', $nasabah->id)
                ->where('status_pembayaran', 'belum_lunas');
        })
            ->where('status', 'unpaid')
            ->whereDate('tanggal_jatuh_tempo', '>=', now())
            ->orderBy('tanggal_jatuh_tempo')
            ->take(5)
            ->get();

        return view('dashboard.nasabah', compact('stats', 'recentPengajuan', 'upcomingAngsuran'));
    }
}
