<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    public function index()
    {
        $karyawan = Pegawai::with('jabatan')->get();
        return view('karyawan.pegawai', compact('karyawan'));
    }

    public function tampil()
    {
        $karyawan = Pegawai::with('jabatan')->orderBy('nama', 'asc')->get();
        return view('profil', compact('karyawan'));
    }

    public function create()
    {
        $jabatans = Jabatan::all();
        return view('karyawan.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nama_jabatan' => 'required',
            'image' => 'required|image|mimes:jpeg,png|max:2048'
        ]);

        try {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('foto'), $imageName);

            $jabatan = Jabatan::where('nama_jabatan', $request->nama_jabatan)->first();

            Pegawai::create([
                'nama' => $request->nama,
                'id_jabatan' => $jabatan->id,
                'image' => $imageName
            ]);

            Alert::success('Success', 'Data pegawai berhasil ditambahkan.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menambahkan data pegawai.');
        }

        return redirect()->route('karyawan.pegawai');
    }

    public function edit($id)
    {
        $karyawan = Pegawai::findOrFail($id);
        $jabatans = Jabatan::all();
        return view('karyawan.edit', compact('karyawan', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nama_jabatan' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png|max:2048'
        ]);

        $karyawan = Pegawai::findOrFail($id);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('foto'), $imageName);

                if ($karyawan->image) {
                    $oldImagePath = public_path('foto/' . $karyawan->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $karyawan->image = $imageName;
            }

            $jabatan = Jabatan::where('nama_jabatan', $request->nama_jabatan)->first();

            $updateData = [
                'nama' => $request->nama,
                'id_jabatan' => $jabatan->id,
            ];

            if (isset($imageName)) {
                $updateData['image'] = $imageName;
            }

            $karyawan->update($updateData);

            Alert::success('Success', 'Data pegawai berhasil diupdate.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengupdate data pegawai.');
        }

        return redirect()->route('karyawan.pegawai');
    }

    public function destroy($id)
    {
        $karyawan = Pegawai::findOrFail($id);

        try {
            if ($karyawan->image) {
                $imagePath = public_path('foto/' . $karyawan->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $karyawan->delete();

            Alert::success('Deleted', 'Data pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menghapus data pegawai.');
        }

        return redirect()->route('karyawan.pegawai');
    }
}