<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::all();
        return view('admin.nasabah.index', compact('nasabah'));
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|unique:nasabah',
            'telephone' => 'nullable|string|unique:nasabah',
            'email' => 'nullable|email|unique:nasabah',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'pekerjaan' => 'nullable|string',
            'alamat_kantor_usaha' => 'nullable|string',
            'agama' => 'nullable|string',
            'rt_rw' => 'nullable|string',
            'dsn' => 'nullable|string',
            'ds' => 'nullable|string',
            'kec' => 'nullable|string',
            'kab' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'status_perkawinan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Create user account
            $user = User::create([
                'name' => $validated['nama_lengkap'],
                'email' => $validated['email'] ?? null,
                'telephone' => $validated['telephone'] ?? null,
                'password' => Hash::make('password123'), // Default password
                'role' => 'nasabah',
                'status' => 'active'
            ]);

            $validated['user_id'] = $user->id;

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = time() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $foto->getClientOriginalExtension();
                $validated['foto'] = Storage::putFileAs('public/nasabah', $foto, $filename . '.' . $extension);
            }

            Nasabah::create($validated);
            DB::commit();

            return redirect()->route('nasabah.index')->with('success', 'Data nasabah dan akun berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Nasabah $nasabah)
    {
        return view('admin.nasabah.show', compact('nasabah'));
    }

    public function edit(Nasabah $nasabah)
    {
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|unique:nasabah,nik,' . $nasabah->id,
            'telephone' => 'nullable|string|unique:nasabah,telephone,' . $nasabah->id,
            'email' => 'nullable|email|unique:nasabah,email,' . $nasabah->id,
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'pekerjaan' => 'nullable|string',
            'alamat_kantor_usaha' => 'nullable|string',
            'agama' => 'nullable|string',
            'rt_rw' => 'nullable|string',
            'dsn' => 'nullable|string',
            'ds' => 'nullable|string',
            'kec' => 'nullable|string',
            'kab' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'status_perkawinan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Update user account
            $user = User::find($nasabah->user_id);
            $user->update([
                'name' => $validated['nama_lengkap'],
                'email' => $validated['email'] ?? $user->email,
                'telephone' => $validated['telephone'] ?? $user->telephone,
            ]);

            if ($request->hasFile('foto')) {
                // Delete old foto
                if ($nasabah->foto) {
                    Storage::delete($nasabah->foto);
                }

                $foto = $request->file('foto');
                $filename = time() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $foto->getClientOriginalExtension();
                $validated['foto'] = Storage::putFileAs('public/nasabah', $foto, $filename . '.' . $extension);
            }

            $nasabah->update($validated);
            DB::commit();

            return redirect()->route('nasabah.index')->with('success', 'Data nasabah dan akun berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Nasabah $nasabah)
    {
        if ($nasabah->foto) {
            Storage::delete($nasabah->foto);
        }
        $nasabah->delete();
        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil dihapus');
    }
}
