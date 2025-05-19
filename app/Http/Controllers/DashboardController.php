<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Angsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'manajer') {
            return $this->adminDashboard();
        } elseif ($user->role === 'nasabah') {
            return $this->nasabahDashboard();
        } else {
            return $this->marketingDashboard();
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

        $currentYear = request('year', now()->year);

        $monthlySubmissions = Pengajuan::selectRaw('MONTH(created_at) as month, SUM(nominal_pengajuan) as total')
            ->whereYear('created_at', $currentYear)
            ->where('status', 'accepted')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->all();

        // Fill in missing months with zero
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = $monthlySubmissions[$i] ?? 0;
        }

        // Ganti bagian mendapatkan years dengan range tahun 2000-sekarang
        $years = collect(range(2000, now()->year))->reverse();

        return view('dashboard.admin', compact('stats', 'recentPengajuan', 'recentAngsuran', 'monthlyData', 'currentYear', 'years'));
    }

    protected function nasabahDashboard()
    {
        $nasabah = Auth::user()->nasabah;

        if (!$nasabah) {
            return redirect()->route('nasabah.profile')->with('warning', 'Lengkapi profil nasabah terlebih dahulu');
        }

        $stats = [
            'total_pengajuan' => $nasabah->pengajuan()->count(),
            'pengajuan_aktif' => $nasabah->pengajuan()->where('status', 'accepted')->where('status_pembayaran', 'belum_lunas')->count(),
            'pengajuan_lunas' => $nasabah->pengajuan()->where('status', 'accepted')->where('status_pembayaran', 'lunas')->count(),
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

    protected function marketingDashboard()
    {
        $stats = [
            'pengajuan_disurvei' => Pengajuan::whereHas('survei', function ($query) {
                $query->where('marketing_id', auth()->user()->id);
            })->count(),
            'pengajuan_baru' => Pengajuan::whereDoesntHave('survei')->count(),
            'pengajuan_diterima' => Pengajuan::whereHas('survei', function ($query) {
                $query->where('marketing_id', auth()->user()->id)->where('status_aplikasi', 'disetujui');
            })->count(),
            'pengajuan_ditolak' => Pengajuan::whereHas('survei', function ($query) {
                $query->where('marketing_id', auth()->user()->id)->where('status_aplikasi', 'ditolak');
            })->count(),
        ];

        $monthlySubmissions = Pengajuan::selectRaw('MONTH(tanggal_pengajuan) as month, COUNT(*) as count')
            ->whereYear('tanggal_pengajuan', now()->year)
            ->groupByRaw('MONTH(tanggal_pengajuan)')
            ->pluck('count', 'month');

        return view('dashboard.marketing', compact('stats', 'monthlySubmissions'));
    }
}
