<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('berita.index', compact('news'));
    }

    public function tampil()
    {
        $news = News::latest()->paginate(10);
        return view('news.news', compact('news'));
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.detail', compact('news'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tgl' => 'required|date',
            'isi' => 'required',
            'image' => 'required|image|mimes:jpeg,png|max:5048'
        ]);

        try {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('poster'), $imageName);

            News::create([
                'judul' => $request->judul,
                'tgl' => $request->tgl,
                'isi' => $request->isi,
                'image' => $imageName
            ]);

            Alert::success('Success', 'Data news berhasil ditambahkan.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menambahkan data news.');
        }

        return redirect()->route('berita.index');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('berita.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required',
            'tgl' => 'required|date',
            'isi' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png|max:5048'
        ]);

        // Cari pegawai berdasarkan ID
        $news = News::findOrFail($id);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('poster'), $imageName);

                if ($news->image) {
                    $oldImagePath = public_path('poster/' . $news->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $news->image = $imageName;
            }

            $updateData = [
                'judul' => $request->judul,
                'tgl' => $request->tgl,
                'isi' => $request->isi
            ];

            if (isset($imageName)) {
                $updateData['image'] = $imageName;
            }

            $news->update($updateData);

            Alert::success('Success', 'Data news berhasil diupdate.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengupdate data news.');
        }

        return redirect()->route('berita.index');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        try {
            if ($news->image) {
                $imagePath = public_path('poster/' . $news->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $news->delete();

            Alert::success('Deleted', 'Data pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menghapus data pegawai.');
        }

        return redirect()->route('berita.index');
    }
}
