<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    /**
     * Get the admin user.
     */
    private function getAdmin(): User
    {
        return User::where('role', 'admin')->firstOrFail();
    }

    /**
     * Show the user's chat page.
     */
    public function index()
    {
        $admin = $this->getAdmin();
        $user  = Auth::user();

        // Check if there's any conversation history
        $count = Message::between($user->id, $admin->id)->count();

        if ($count === 0) {
            Message::create([
                'sender_id'   => $admin->id,
                'receiver_id' => $user->id,
                'body'        => 'Welcome! 👋 How can I help you today?',
                'type'        => 'text',
                'read_at'     => null,
            ]);
        } else {
            // Mark all admin → user messages as read
            Message::where('sender_id', $admin->id)
                ->where('receiver_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('Pages.chat', compact('admin'));
    }

    /**
     * AJAX: Fetch messages between user and admin.
     */
    public function fetchMessages(Request $request)
    {
        $admin = $this->getAdmin();
        $user  = Auth::user();

        $messages = Message::between($user->id, $admin->id)
            ->with(['sender:id,name,role', 'sender.profile'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) use ($user) {
                return [
                    'id'         => $msg->id,
                    'body'       => $msg->body,
                    'type'       => $msg->type,
                    'file_url'   => $msg->file_url,
                    'file_name'  => $msg->file_name,
                    'is_mine'    => $msg->sender_id === $user->id,
                    'read_at'    => $msg->read_at?->toISOString(),
                    'time'       => $msg->created_at->format('h:i A'),
                    'avatar'     => $msg->sender->profile->profile_photo_url,
                    'sender'     => $msg->sender->name,
                ];
            });

        // Mark incoming messages as read
        Message::where('sender_id', $admin->id)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['messages' => $messages]);
    }

    /**
     * AJAX: Send a message to admin.
     */
    public function send(Request $request)
    {
        $request->validate([
            'body' => 'nullable|string|max:5000',
            'file' => 'nullable|file|max:10240',
        ]);

        $admin  = $this->getAdmin();
        $user   = Auth::user();
        $type   = 'text';
        $filePath = null;
        $fileName = null;

        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $mime     = $file->getMimeType();
            $type     = str_starts_with($mime, 'image/') ? 'image' : 'file';
            $filePath = $file->store('chat-files', 'public');
        }

        $msg = Message::create([
            'sender_id'   => $user->id,
            'receiver_id' => $admin->id,
            'body'        => $request->input('body'),
            'type'        => $type,
            'file_path'   => $filePath,
            'file_name'   => $fileName,
        ]);

        // Send Email Notification to Admin manually
        try {
            \Illuminate\Support\Facades\Mail::to($admin->email)->send(new \App\Mail\UserChatMessage($user, $msg));
        } catch (\Exception $e) {
            // fail silently, do not disrupt message flow
        }

        return response()->json([
            'success' => true,
            'message' => [
                'id'        => $msg->id,
                'body'      => $msg->body,
                'type'      => $msg->type,
                'file_url'  => $msg->file_url,
                'file_name' => $msg->file_name,
                'is_mine'   => true,
                'read_at'   => null,
                'time'      => $msg->created_at->format('h:i A'),
                'avatar'    => $user->profile->profile_photo_url,
            ],
        ]);
    }

    /**
     * AJAX: Ping to mark user online.
     */
    public function ping()
    {
        $user = Auth::user();
        $user->update([
            'is_online'    => true,
            'last_seen_at' => now(),
        ]);

        $admin = $this->getAdmin();
        return response()->json([
            'admin_online' => $admin->is_online,
            'admin_last_seen' => $admin->last_seen_at
                ? \Carbon\Carbon::parse($admin->last_seen_at)->diffForHumans()
                : null,
        ]);
    }

    /**
     * AJAX: Mark user offline.
     */
    public function goOffline()
    {
        $user = Auth::user();
        $user->update([
            'is_online'    => false,
            'last_seen_at' => now(),
        ]);
        return response()->json(['ok' => true]);
    }

    /**
     * AJAX: Get unread count from admin (for navbar badge).
     */
    public function unreadCount()
    {
        $admin = $this->getAdmin();
        $user  = Auth::user();

        $count = Message::where('sender_id', $admin->id)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }
}
