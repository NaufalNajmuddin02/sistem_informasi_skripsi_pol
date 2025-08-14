<?php

namespace App\Http\Controllers\kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriProposal;

class KategoriProposalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kategoris = KategoriProposal::when($search, function ($query, $search) {
            return $query->where('nama_kategori', 'like', '%' . $search . '%');
        })->orderBy('nama_kategori')->paginate(10);

        return view('kaprodi.kategori.index', compact('kategoris', 'search'));
    }

    public function create()
    {
        return view('kaprodi.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriProposal::create($request->only('nama_kategori'));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriProposal::findOrFail($id);
        return view('kaprodi.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriProposal::findOrFail($id);
        $kategori->update($request->only('nama_kategori'));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriProposal::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
