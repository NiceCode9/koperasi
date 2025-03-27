<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('jabatan.admin', compact('jabatan'));
    }

    public function create()
    {
        return view('jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
        ]);

        try {
            Jabatan::create($request->all());
            Alert::success('Success', 'Data jabatan berhasil ditambahkan');
        } catch (Exception $e) {
            Alert::error('Failed', 'Data jabatan gagal ditambahkan: ' . $e->getMessage());
        }

        return redirect()->route('jabatan.admin');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
        ]);

        try {
            $jabatan->update($request->all());
            Alert::success('Success', 'Data jabatan berhasil diupdate');
        } catch (Exception $e) {
            Alert::error('Failed', 'Data jabatan gagal diupdate: ' . $e->getMessage());
        }

        return redirect()->route('jabatan.admin');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        try {
            $jabatan->delete();
            Alert::success('Deleted', 'Data jabatan berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Failed', 'Data jabatan gagal dihapus: ' . $e->getMessage());
        }

        return redirect()->route('jabatan.admin');
    }
}
