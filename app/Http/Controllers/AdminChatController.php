<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminChatController extends Controller
{
    /**
     * Admin chat inbox: list all users who have sent messages.
     */
    public function index()
    {
        $admin = Auth::user();

        // Get all unique users who have chatted with admin
        $senderIds = Message::where('receiver_id', $admin->id)
            ->select('sender_id')
            ->distinct()
            ->pluck('sender_id');

        $receiverIds = Message::where('sender_id', $admin->id)
            ->select('receiver_id')
            ->distinct()
            ->pluck('receiver_id');

        $userIds = $senderIds->merge($receiverIds)->unique()->values();

        $users = User::whereIn('id', $userIds)
            ->where('role', '!=', 'admin')
            ->with('profile')
            ->get()
            ->map(function ($user) use ($admin) {
                $lastMsg = Message::between($user->id, $admin->id)
                    ->latest()
                    ->first();

                $unread = Message::where('sender_id', $user->id)
                    ->where('receiver_id', $admin->id)
                    ->whereNull('read_at')
                    ->count();

                return [
                    'id'          => $user->id,
                    'name'        => $user->name,
                    'email'       => $user->email,
                    'is_online'   => $user->is_online,
                    'last_seen'   => $user->last_seen_at ? \Carbon\Carbon::parse($user->last_seen_at)->diffForHumans() : null,
                    'avatar'      => $user->profile->profile_photo_url,
                    'last_message'=> $lastMsg?->body ?? ($lastMsg?->type === 'image' ? '📷 Image' : '📎 File'),
                    'last_time'   => $lastMsg?->created_at->format('h:i A'),
                    'unread'      => $unread,
                ];
            })
            ->sortByDesc(function ($u) {
                return $u['last_time'];
            })
            ->values();

        return view('Admin.chat', compact('users'));
    }

    /**
     * AJAX: Fetch messages for a conversation with a specific user.
     */
    public function fetchMessages(Request $request, $userId)
    {
        $admin = Auth::user();
        $user  = User::findOrFail($userId);

        $messages = Message::between($user->id, $admin->id)
            ->with(['sender:id,name,role', 'sender.profile'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) use ($admin) {
                return [
                    'id'        => $msg->id,
                    'body'      => $msg->body,
                    'type'      => $msg->type,
                    'file_url'  => $msg->file_url,
                    'file_name' => $msg->file_name,
                    'is_mine'   => $msg->sender_id === $admin->id,
                    'read_at'   => $msg->read_at?->toISOString(),
                    'time'      => $msg->created_at->format('h:i A'),
                    'avatar'    => $msg->sender->profile->profile_photo_url,
                    'sender'    => $msg->sender->name,
                ];
            });

        // Mark all user → admin messages as read
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $admin->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $userInfo = [
            'id'        => $user->id,
            'name'      => $user->name,
            'is_online' => $user->is_online,
            'last_seen' => $user->last_seen_at ? \Carbon\Carbon::parse($user->last_seen_at)->diffForHumans() : null,
            'avatar'    => $user->profile->profile_photo_url,
        ];

        return response()->json([
            'messages' => $messages,
            'user'     => $userInfo,
        ]);
    }

    /**
     * AJAX: Admin sends a reply to a user.
     */
    public function send(Request $request, $userId)
    {
        $request->validate([
            'body' => 'nullable|string|max:5000',
            'file' => 'nullable|file|max:10240',
        ]);

        $admin    = Auth::user();
        $user     = User::findOrFail($userId);
        $type     = 'text';
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
            'sender_id'   => $admin->id,
            'receiver_id' => $user->id,
            'body'        => $request->input('body'),
            'type'        => $type,
            'file_path'   => $filePath,
            'file_name'   => $fileName,
        ]);

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
                'avatar'    => $admin->profile->profile_photo_url,
            ],
        ]);
    }

    /**
     * AJAX: Total unread count + sender list for notification dropdown.
     */
    public function totalUnread()
    {
        $admin   = Auth::user();
        $adminId = $admin->id;

        $total = Message::where('receiver_id', $adminId)
            ->whereNull('read_at')
            ->count();

        // Unique senders with unread messages
        $senderIds = Message::where('receiver_id', $adminId)
            ->whereNull('read_at')
            ->select('sender_id')
            ->distinct()
            ->pluck('sender_id');

        $senders = User::whereIn('id', $senderIds)->get()->map(function ($user) use ($adminId) {
            $unread  = Message::where('sender_id', $user->id)
                ->where('receiver_id', $adminId)
                ->whereNull('read_at')
                ->count();
            $lastMsg = Message::where('sender_id', $user->id)
                ->where('receiver_id', $adminId)
                ->whereNull('read_at')
                ->latest()
                ->first();
            return [
                'id'        => $user->id,
                'name'      => $user->name,
                'unread'    => $unread,
                'message'   => $lastMsg?->body ?? '📎 Attachment',
                'time'      => $lastMsg?->created_at->diffForHumans() ?? '',
                'is_online' => (bool) ($user->is_online ?? false),
            ];
        })->sortByDesc('unread')->values();

        return response()->json([
            'total'   => $total,
            'senders' => $senders,
        ]);
    }

    /**
     * AJAX: Admin ping (mark admin online).
     */
    public function ping()
    {
        $admin = Auth::user();
        $admin->update([
            'is_online'    => true,
            'last_seen_at' => now(),
        ]);
        return response()->json(['ok' => true]);
    }

    /**
     * AJAX: Mark admin offline.
     */
    public function goOffline()
    {
        $admin = Auth::user();
        $admin->update([
            'is_online'    => false,
            'last_seen_at' => now(),
        ]);
        return response()->json(['ok' => true]);
    }
}
