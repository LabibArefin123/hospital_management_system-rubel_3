<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /* =========================================================
        STORE CONTACT
    ========================================================= */
    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:contacts,name',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'department' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:2000',
        ]);

        DB::beginTransaction();

        try {

            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'department' => $request->department,
                'service' => $request->service,
                'message' => $request->message,
            ]);

            DB::commit();

            return back()->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Something went wrong!');
        }
    }

    /* =========================================================
        INDEX PAGE
    ========================================================= */
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('backend.contact.index', compact('contacts'));
    }

    /* =========================================================
        SHOW PAGE
    ========================================================= */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('backend.contact.show', compact('contact'));
    }

    /* =========================================================
        DELETE
    ========================================================= */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return back()->with('success', 'Contact deleted successfully!');
    }
}
