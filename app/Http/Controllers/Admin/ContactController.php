<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // 1. Inbox mein saare messages dikhana (Naye sab se upar)
    public function index()
    {
        $messages = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.index', compact('messages'));
    }

    // 2. Message ko "Read" (Parh liya) mark karna
    public function update(Request $request, Contact $contact)
    {
        $contact->update(['status' => 'read']);
        return back()->with('success', 'Message marked as read.');
    }

    // 3. Message ko hamesha ke liye Delete karna
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Message securely deleted.');
    }
}