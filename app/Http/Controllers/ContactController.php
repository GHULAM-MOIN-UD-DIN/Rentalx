<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Notification;
use App\Models\User;
use App\Mail\ContactReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display contact page (Frontend)
     */
    public function contact()
    {
        return view('Pages.contact');
    }

    /**
     * Store contact form submission (Frontend)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|max:255',
            'phone'              => 'nullable|string|max:20',
            'subject'            => 'nullable|string|max:255',
            'preferred_vehicle'  => 'nullable|string|max:100',
            'start_date'         => 'nullable|date',
            'end_date'           => 'nullable|date|after_or_equal:start_date',
            'message'            => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the errors below.');
        }

        try {
            Contact::create([
                'user_id'           => auth()->id(),
                'name'              => $request->name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'subject'           => $request->subject,
                'preferred_vehicle' => $request->preferred_vehicle,
                'start_date'        => $request->start_date,
                'end_date'          => $request->end_date,
                'message'           => $request->message,
            ]);

            return redirect()->route('contact.page')
                ->with('success', 'Your message has been sent! Our concierge team will contact you within 4 minutes.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display contact list (Admin)
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name',      'LIKE', "%{$search}%")
                  ->orWhere('email',   'LIKE', "%{$search}%")
                  ->orWhere('phone',   'LIKE', "%{$search}%")
                  ->orWhere('subject', 'LIKE', "%{$search}%")
                  ->orWhere('message', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'replied') {
                $query->whereNotNull('replied_at');
            } elseif ($request->status === 'pending') {
                $query->whereNull('replied_at');
            }
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('Admin.contactlist', compact('contacts'));
    }

    /**
     * Show single contact (Admin)
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('Admin.contactshow', compact('contact'));
    }

    /**
     * Reply to contact — sends email + in-app notification (Admin)
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required|string|min:10|max:5000',
        ]);

        $contact = Contact::findOrFail($id);

        // ── 1. Save reply to DB ──────────────────────────────────
        $contact->update([
            'admin_reply' => $request->admin_reply,
            'replied_at'  => now(),
        ]);

        // ── 2. Send reply email ──────────────────────────────────
        try {
            Mail::to($contact->email)->send(new ContactReplyMail(
                $contact->name,
                $contact->email,
                $contact->message,
                $request->admin_reply,
                $contact->subject
            ));
        } catch (\Exception $e) {
            Log::error('Contact reply email failed: ' . $e->getMessage());
        }

        // ── 3. In-app Notification (if user has an account) ──────
        try {
            $user = null;
            if ($contact->user_id) {
                $user = User::find($contact->user_id);
            }
            if (!$user) {
                $user = User::where('email', $contact->email)->first();
            }

            if ($user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title'   => '📩 Admin replied to your inquiry',
                    'message' => 'RENTALX team has replied to your contact message' .
                                 ($contact->subject ? ' regarding "' . $contact->subject . '"' : '') .
                                 '. Check your email for the full reply.',
                    'link'    => null,
                    'type'    => 'info',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Contact reply notification failed: ' . $e->getMessage());
        }

        return redirect()->route('admin.contacts.index')
            ->with('success', '✅ Reply sent to ' . $contact->email . ' successfully!');
    }

    /**
     * Delete contact (Admin)
     */
    public function destroy($id)
    {
        try {
            Contact::findOrFail($id)->delete();
            return redirect()->route('admin.contacts.index')
                ->with('success', 'Contact message deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contacts.index')
                ->with('error', 'Failed to delete contact message.');
        }
    }
}