<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Address;
use App\User;
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
        return view('contacts.index', [
            'users' => User::orderBy('created_at', 'asc')->get(),
            'addresses' => Address::orderBy('created_at', 'asc')->get(),
            'contacts' => $this->contacts->getContacts(),
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            // 'name' => 'required|max:255',
            'date' => 'required',
            'result' => 'required',
        ]);
        // $request->user()->boxes()->create([
        //     'name' => $request->name,
        // ]);
        $request->user()->contacts()->create([
            'date' => $request->date,
            'result' => $request->result,
            'support_lvl' => $request->support_lvl,
            'notes' => $request->notes
        ]);
        $contact->save();
        return redirect('/contacts');
    }

    public function destroy(Request $request, Contact $contact) {
        $this->authorize('destroy', $contact);
        $contact->delete();
        return redirect('/contacts');
    }


}
