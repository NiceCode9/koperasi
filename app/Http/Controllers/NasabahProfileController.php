<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NasabahProfileController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::where('user_id', auth()->id())->first();
        return view('nasabah.profile', compact('nasabah'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required',
            'telephone' => 'required',
            'email' => 'required|email',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'pekerjaan' => 'required',
            'alamat_kantor_usaha' => 'required',
            'agama' => 'required',
            'rt_rw' => 'required',
            'dsn' => 'required',
            'ds' => 'required',
            'kec' => 'required',
            'kab' => 'required',
            'kode_pos' => 'required',
            'status_perkawinan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $nasabah = Nasabah::where('user_id', auth()->id())->first();
        if (!$nasabah) {
            $nasabah = new Nasabah();
            $nasabah->user_id = auth()->id();
        }

        // Handle foto upload
        if ($request->hasFile('foto')) {
            if ($nasabah->foto) {
                Storage::delete($nasabah->foto);
            }
            $nasabah->foto = $request->file('foto')->store('nasabah-photos');
        }

        // Update other fields
        $nasabah->fill($request->except('foto'));
        $nasabah->save();

        return redirect()->route('nasabah.profile')->with('success', 'Profile berhasil diperbarui');
    }
}
