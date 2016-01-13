<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Address;
use App\User;
use Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;

class ContactController extends Controller
{
    protected $contacts;

    public function __construct(ContactRepository $contacts) {
        $this->middleware('auth');
        $this->contacts = $contacts;
    }

    public function index(Request $request) {
        // $contacts = Contact::with('address', 'user')->getContacts();
        // return view('contacts.index', compact($contacts));
        return view('contacts.index', [
            'contacts' => $this->contacts->getContacts(),
        ]);
    }

    public function addContact(Request $request) {
        return view('contacts.add', [
            'users' => User::orderBy('created_at', 'asc')->get(),
            'addresses' => Address::orderBy('created_at', 'asc')->get(),
        ]);
    }

    public function editContact(Request $request, Contact $contact) {
        return view('contacts.add', [
            'contact' => $contact,
        ]);
    }

    public function store(Request $request) {
        Log::info($request);
        $this->validate($request, [
            'date' => 'required',
            'result' => 'required',
        ]);
        $contact = new Contact();
        $contact->date = $request->date;
        $contact->result = $request->result;
        $contact->support_lvl = $request->support_lvl;
        $contact->notes = $request->notes;
        $contact->user_id = $request->user_id;
        $contact->address_id = $request->address;
        $contact->save();
        return redirect('/contacts');
    }

    public function destroy(Request $request, Contact $contact) {
        $this->authorize('destroy', $contact);
        $contact->delete();
        return redirect('/contacts');
    }


}
