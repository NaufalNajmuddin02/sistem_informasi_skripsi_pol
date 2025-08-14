<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $notifications = Notification::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function store(Request $request)
    {
        Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Notifikasi berhasil ditambahkan!');
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if ($notification && $notification->user_id === Auth::id()) {
            $notification->update(['read_at' => now()]);
        }

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $notification = Notification::find($id);

        if ($notification && $notification->user_id === Auth::id()) {
            $notification->delete();
        }

        return redirect()->back();
    }

    public function deleteAll()
    {
        Notification::where('user_id', Auth::id())->delete();

        return redirect()->back();
    }
}
