<?php
namespace App\Http\Controllers\kaprodi\mapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class CommentKaprodiController extends Controller
{

    public function store(Request $request)
    {
        Log::info($request->all()); // Simpan log request
    
        $request->validate([
            'proposal_id' => 'required|exists:proposals,id',
            'comment' => 'required|string'
        ]);
    
        Comment::create([
            'proposal_id' => $request->proposal_id,
            'user_id' => auth()->id(),
            'comment' => $request->comment
        ]);
    
        return response()->json(['message' => 'Komentar berhasil ditambahkan']);
    }

}
