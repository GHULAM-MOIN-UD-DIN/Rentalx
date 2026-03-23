<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(15);
        return view('pages.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->update(['read_at' => now()]);

        if ($notification->link) {
            return redirect($notification->link);
        }

        return back();
    }
}
