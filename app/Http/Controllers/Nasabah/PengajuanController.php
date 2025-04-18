<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::query();

        if (Auth::user()->role == 'nasabah') {
            if (empty(Auth::user()->nasabah)) {
                Alert::warning('Peringatan', 'Silahkan lengkapi profil anda terlebih dahulu');
                return redirect()->route('nasabah.profile');
            }
            $pengajuan->where('nasabah_id', Auth::user()->nasabah->id);
        }

        if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer') {
            $pengajuan->where('status', '!=', 'pending');
        }

        $pengajuan->orderBy('created_at', 'desc');
        $pengajuan = $pengajuan->paginate(10);
        $pengajuan->appends(request()->query());

        return view('nasabah.pengajuan.pengajuan', compact('pengajuan'));
    }

    public function form(Pengajuan $pengajuan = null)
    {
        $nasabah = Auth::user()->nasabah;
        return view('nasabah.pengajuan.form-pengajuan', compact('nasabah', 'pengajuan'));
    }

    public function store(Request $request)
    {
        $nasabah = Auth::user()->nasabah;

        $validated = $request->validate([
            'jangka_waktu' => 'required|in:3,12,24,36',
            'nominal_pengajuan' => 'required|numeric',
            'keperluan' => 'required|string',
            'jaminan' => 'required|string',
            'ahli_waris' => 'required|string',
            'pemilik_jaminan' => 'required|string',
            'dokumen' => 'required|file|mimes:pdf,jpg'
        ]);

        $dokumen = null;
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $extension = $file->getClientOriginalExtension();
            $dokumen = Str::random(32) . '.' . $extension;
            Storage::disk('public')->put('dokumen/' . $dokumen, file_get_contents($file));
        }

        $validated['nomor_pengajuan'] = 'PGJ-' . now()->format('Ymd') . Str::random(5);
        $validated['nasabah_id'] = $nasabah->id;
        $validated['dokumen_pendukung'] = $dokumen;
        $validated['status'] = 'pending';
        $validated['tanggal_pengajuan'] = now()->format('Y-m-d');

        Pengajuan::create($validated);

        Alert::success('Berhasil', 'Pengajuan Berhasil Dibuat');
        return redirect()->route('nasabah.pengajuan.index');
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $validated = $request->validate([
            'jangka_waktu' => 'required|in:3,12,24,36',
            'nominal_pengajuan' => 'required|numeric',
            'keperluan' => 'required|string',
            'jaminan' => 'required|string',
            'ahli_waris' => 'required|string',
            'pemilik_jaminan' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,jpg'
        ]);

        if ($request->hasFile('dokumen')) {
            // Delete old file if exists
            if ($pengajuan->dokumen_pendukung) {
                Storage::disk('public')->delete('dokumen/' . $pengajuan->dokumen_pendukung);
            }

            $file = $request->file('dokumen');
            $extension = $file->getClientOriginalExtension();
            $dokumen = Str::random(32) . '.' . $extension;
            Storage::disk('public')->put('dokumen/' . $dokumen, file_get_contents($file));
            $validated['dokumen_pendukung'] = $dokumen;
        }

        $pengajuan->update($validated);

        Alert::success('Berhasil', 'Pengajuan Berhasil Diperbarui');
        return redirect()->route('nasabah.pengajuan.index');
    }

    public function destroy(string $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        if ($pengajuan->dokumen_pendukung) {
            Storage::disk('public')->delete('dokumen/' . $pengajuan->dokumen_pendukung);
        }
        $pengajuan->delete();

        Alert::success('Berhasil', 'Pengajuan Berhasil Dihapus');
        return redirect()->route('nasabah.pengajuan.index');
    }

    public function verifikasi(string $id)
    {
        $pengajuan = Pengajuan::with(['survei', 'nasabah'])->findOrFail($id);
        return view('admin.verifikasi', compact('pengajuan'));
    }

    public function hasilSurvei(string $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('admin.hasil-survei-pdf', compact('pengajuan'));
    }
}
