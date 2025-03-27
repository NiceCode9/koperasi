<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.index', compact('user'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|confirmed'
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            Alert::success('Success', 'Data admin berhasil ditambahkan.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menambahkan data admin.');
        }

        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:users,name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed'
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            Alert::success('Success', 'Data admin berhasil diupdate.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengupdate data admin.');
        }

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
            Alert::success('Deleted', 'Data admin berhasil dihapus');
        } catch (\Exception $e) {
            Alert::error('Failed', 'Data admin gagal dihapus: ' . $e->getMessage());
        }

        return redirect()->route('admin.index');
    }
}
