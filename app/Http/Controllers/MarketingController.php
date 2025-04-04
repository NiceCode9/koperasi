<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Nasabah;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function pengajuan()
    {
        $pengajuan = Pengajuan::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('nasabah.pengajuan.pengajuan', compact('pengajuan'));
    }

    public function createSurvei(string $id)
    {
        $pengajuan = Pengajuan::with('nasabah')->find($id);
        return view('marketing.form-survei', compact('pengajuan'));
    }

    public function storeSuvei(Request $request)
    {
        $request->validate([
            'pengajuan_id' => 'required|exists:pengajuan,id',
            'tanggal_survei' => 'required|date',
            'jumlah_plafon' => 'required',
            'hubungan_dengan_bmt' => 'required',
            'detail_penggunaan_dana' => 'required',
            'jenis_usaha' => 'required',
            'lama_usaha_tahun' => 'required',
            'jumlah_tenaga_kerja' => 'required',
            'sistem_penjualan' => 'required',
            'persediaan_barang' => 'required',
            'aset_properti' => 'required',
            'jumlah_motor' => 'required',
            'nilai_motor' => 'required',
            'jumlah_mobil' => 'required',
            'nilai_mobil' => 'required',
            // 'total_aset' => 'required',
            'kebutuhan_pokok' => 'required',
            'biaya_pendidikan' => 'required',
            'pengeluaran_lainnya' => 'required',
            // 'total_pengeluaran_rutin' => 'required',
            'selisih_dana' => 'required',
            'kemampuan_bayar' => 'required',
        ]);

        $pengajuan = Pengajuan::find($request->pengajuan_id);
        $pengajuan->update([
            'status' => 'survei',
        ]);

        Assignment::create();
    }
}
