<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('telephone', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();

        return view('admin.users.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $request->merge([
            'password' => bcrypt($request->password),
        ]);
        User::create($request->all());
        Alert::success('Success', 'User berhasil ditambahkan.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);

        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password),
            ]);
        } else {
            $request->merge([
                'password' => $user->password,
            ]);
        }

        $user->update($request->all());
        Alert::success('Success', 'User berhasil diubah.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        Alert::success('Success', 'User berhasil dihapus.');
        return redirect()->route('admin.users.index');
    }

    public function updateStatus(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah',
            'status' => $user->status
        ]);
    }
}
