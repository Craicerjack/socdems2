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

    public function getLocale() {
        Log::info($this);
    }

    public function index(Request $request) {
        // $contacts = Contact::with('address', 'user')->getContacts();
        // return view('contacts.index', compact($contacts));
        return view('contacts.index', [
            'contacts' => $this->contacts->getContacts(),
        ]);
    }

    public function returnJson(Request $request) {
        try{
           $statusCode = 200;
           $addresses = Address::orderBy('created_at', 'asc')->get();
       } catch (Exception $e) {
           $statusCode = 400;
       } finally {
           return response()->json($addresses);
       }
    }

    public function addContact(Request $request) {
        $addresses = Address::orderBy('created_at', 'asc')->get();
        $locale = array();

        foreach ($addresses as $add) {
            ($add['address_town'] == '') ? $at = $add["address_st"] : $at = $add['address_town'];
            array_push($locale, $at);
        }
        $locale = array_unique($locale);
        return view('contacts.add', [
            'users' => User::orderBy('created_at', 'asc')->get(),
            'addresses' => $addresses,
            'locale' => $locale,
        ]);
    }

    public function editContact(Request $request, Contact $contact) {
        return view('contacts.add', [
            'contact' => $contact,
        ]);
    }

    public function store(Request $request) {

        Log::info($request);

        // set the locale
        $addresses = Address::orderBy('created_at', 'asc')->get();
        $locale = array();
        foreach ($addresses as $add) {
            ($add['address_town'] == '') ? $at = $add["address_st"] : $at = $add['address_town'];
            array_push($locale, $at);
        }
        $locale = array_unique($locale);


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
        // $contact->save();


        return view('contacts.add', [
            'users' => User::orderBy('created_at', 'asc')->get(),
            'addresses' => $addresses,
            'locale' => $locale,
        ]);


    }

    public function destroy(Request $request, Contact $contact) {
        $this->authorize('destroy', $contact);
        $contact->delete();
        return redirect('/contacts');
    }


}
