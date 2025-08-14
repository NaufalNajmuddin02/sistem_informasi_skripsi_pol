<?php

namespace App\Http\Controllers\dosen\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;
use App\Models\Mapel;
use App\Models\Comment;
use App\Exports\ProposalExport;

class ProposalManagementController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Auth::user();

        if (!$dosen->isDosen()) {
            abort(403, 'Unauthorized action.');
        }

        $search = $request->input('search');
        $tahunAkademik = $request->input('tahun_akademik');

        $mapels = Mapel::where('dosen_id', $dosen->id)
                    ->when($tahunAkademik, fn($q) => $q->where('tahun_akademik', $tahunAkademik))
                    ->orderByDesc('created_at')
                    ->get();

        $proposals = Proposal::with(['kategori', 'comments'])
                    ->where('nama_dosen', $dosen->username)
                    ->when($tahunAkademik, fn($q) => $q->where('tahun_akademik', $tahunAkademik))
                    ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
                    ->orderByDesc('created_at')
                    ->paginate(10);

        $listTahunAkademik = Mapel::where('dosen_id', $dosen->id)
                                ->select('tahun_akademik')
                                ->distinct()
                                ->orderByDesc('tahun_akademik')
                                ->pluck('tahun_akademik');

        return view('dosen.management.management-proposal', compact(
            'proposals', 'mapels', 'search', 'tahunAkademik', 'listTahunAkademik'
        ));
    }

    public function updateStatus(Request $request)
    {
        $proposal = Proposal::findOrFail($request->id);
        $proposal->status = $request->status;
        $proposal->save();

        return response()->json(['success' => 'Status berhasil diperbarui']);
    }

    public function setDeadline(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mapel,id',
            'batas_pengajuan' => 'required|date|after_or_equal:today',
        ]);

        $mapel = Mapel::findOrFail($request->mapel_id);
        $mapel->batas_pengajuan = $request->batas_pengajuan;
        $mapel->save();

        return back()->with('success', 'Batas pengajuan berhasil diperbarui.');
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required|exists:proposals,id',
            'comment' => 'required|string'
        ]);

        Comment::updateOrCreate(
            [
                'proposal_id' => $request->proposal_id,
                'user_id' => Auth::id()
            ],
            ['comment' => $request->comment]
        );

        return redirect()->back()
            ->with('success', 'Komentar berhasil disimpan.')
            ->withInput(); // ⬅ ini penting
    }

    public function semuaProposal(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik');
        $search = $request->input('search');
        $namaDosen = $request->input('nama_dosen');
        $status = $request->input('status');

        $proposals = Proposal::with(['user', 'kategori'])
            ->when($tahunAkademik, fn($q) => $q->where('tahun_akademik', $tahunAkademik))
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($namaDosen, fn($q) => $q->where('nama_dosen', 'like', "%$namaDosen%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderByDesc('created_at')
            ->paginate(20);

        $listTahunAkademik = Proposal::select('tahun_akademik')
            ->distinct()
            ->orderByDesc('tahun_akademik')
            ->pluck('tahun_akademik');


        return view('dosen.management.semua-proposal', compact('proposals', 'tahunAkademik', 'listTahunAkademik','namaDosen','status'));
    }

    public function export(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik');
        $namaDosen = $request->input('nama_dosen');
        $status = $request->input('status');

        return ProposalExport::export($tahunAkademik, $namaDosen, $status);
    }

}
