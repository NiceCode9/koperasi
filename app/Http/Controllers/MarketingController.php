<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Nasabah;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function storeSurvei(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'pengajuan_id' => 'required|exists:pengajuans,id',
                'tanggal_survei' => 'required|date',
                'jumlah_plafon' => 'required',
                'hubungan_dengan_bmt' => 'required',
                'detail_penggunaan_dana' => 'required',
                // 'jenis_usaha' => 'required',
                // 'lama_usaha_tahun' => 'required',
                // 'jumlah_tenaga_kerja' => 'required',
                // 'sistem_penjualan' => 'required',
                // 'persediaan_barang' => 'required',
                // 'aset_properti' => 'required',
                // 'jumlah_motor' => 'required',
                // 'nilai_motor' => 'required',
                // 'jumlah_mobil' => 'required',
                // 'nilai_mobil' => 'required',
                // 'total_aset' => 'required',
                'kebutuhan_pokok' => 'required',
                'biaya_pendidikan' => 'required',
                'pengeluaran_lainnya' => 'required',
                // 'total_pengeluaran_rutin' => 'required',
                // 'selisih_dana' => 'required',
                // 'kemampuan_bayar' => 'required',
            ]);

            $pengajuan = Pengajuan::find($request->pengajuan_id);
            $pengajuan->update([
                'status' => 'survei',
            ]);

            $request->merge(['account_officer_id' => auth()->user()->id]);

            Assignment::create($request->all());
            DB::commit();
            Alert::success('Success', 'Data survei berhasil disimpan');
            return redirect()->route('marketing.pengajuan.survei.index')->with('success', 'Data survei berhasil disimpan');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
            Alert::error('Error', 'Data survei gagal disimpan');
            return redirect()->back()->with('error', 'Data survei gagal disimpan');
        }
    }

    public function updateSurvei(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'pengajuan_id' => 'required|exists:pengajuans,id',
                'tanggal_survei' => 'required|date',
                'jumlah_plafon' => 'required',
                'hubungan_dengan_bmt' => 'required',
                'detail_penggunaan_dana' => 'required',
            ]);

            $pengajuan = Pengajuan::find($request->pengajuan_id);
            $pengajuan->update([
                'status' => 'survei',
            ]);

            $request->merge(['account_officer_id' => auth()->user()->id]);

            Assignment::find($id)->update($request->all());
            DB::commit();
            Alert::success('Success', 'Data survei berhasil diupdate');
            return redirect()->route('marketing.riwayat.survei')->with('success', 'Data survei berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
            Alert::error('Error', 'Data survei gagal diupdate');
            return redirect()->back()->with('error', 'Data survei gagal diupdate');
        }
    }

    public function riwayatSurvei()
    {
        $data = Assignment::with(['pengajuan.nasabah'])->orderBy('created_at', 'desc')->get();
        return view('marketing.riwayat-survei', compact('data'));
    }

    public function showRiwayat(string $id)
    {
        $data = Assignment::with(['pengajuan.nasabah'])->find($id);
        return view('marketing.show-riwayat-survei', compact('data'));
    }

    public function editSurvei(string $id)
    {
        $data = Assignment::with(['pengajuan.nasabah'])->find($id);
        return view('marketing.form-survei', compact('data'));
    }

    public function destroySurvei(string $id)
    {
        DB::beginTransaction();
        try {
            $assignment = Assignment::find($id);
            if ($assignment) {
                $pengajuan = Pengajuan::find($assignment->pengajuan_id);
                $pengajuan->update([
                    'status' => 'pending',
                ]);
                $assignment->delete();
                DB::commit();
                Alert::success('Success', 'Data survei berhasil dihapus');
                return redirect()->route('marketing.riwayat.survei')->with('success', 'Data survei berhasil dihapus');
            } else {
                Alert::error('Error', 'Data survei tidak ditemukan');
                return redirect()->back()->with('error', 'Data survei tidak ditemukan');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', 'Data survei gagal dihapus');
            return redirect()->back()->with('error', 'Data survei gagal dihapus');
        }
    }
}
