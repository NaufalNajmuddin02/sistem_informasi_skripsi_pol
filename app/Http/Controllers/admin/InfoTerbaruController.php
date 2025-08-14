<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InfoTerbaru;
use Illuminate\Http\Request;

class InfoTerbaruController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = InfoTerbaru::when($search, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                        ->orWhere('konten', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->get();

        return view('admin.info_terbaru.index', compact('data', 'search'));
    }


    public function create()
    {
        return view('admin.info_terbaru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
        ]);

        InfoTerbaru::create($request->only('judul', 'konten'));

        return redirect()->route('infoTerbaru.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $info = InfoTerbaru::findOrFail($id);
        return view('admin.info_terbaru.edit', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
        ]);

        $info = InfoTerbaru::findOrFail($id);
        $info->update($request->only('judul', 'konten'));

        return redirect()->route('infoTerbaru.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $info = InfoTerbaru::findOrFail($id);
        $info->delete();

        return redirect()->route('infoTerbaru.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
