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

    public function returnJson(Request $request) {
        try{
            $statusCode = 200;
            if($request->type ==  "electoral_div"){
                $addresses = Address::where("electoral_div", "=", $request->value)->get();
            } else if($request->type ==  "address"){
                $ads = Address::orderBy('created_at', 'asc')->get();
                $addresses = array();
                foreach ($ads as $address) {
                    if($address["address_town"] == $request->value || $address["address_st"] == $request->value) {
                        array_push($addresses, $address);
                     };
                 }
            }
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            Log::info($addresses);
            return response()->json($addresses);
        }
    }

    public function getElectDivs($addresses) {
        $electDivs = array();
        foreach ($addresses as $add) {
            array_push($electDivs, $add->electoral_div);
        }
        $electDivs = array_unique($electDivs);
        return $electDivs;
    }

    public function addContact(Request $request) {
        $addresses = Address::orderBy('created_at', 'asc')->get();
        $electDivs = $this->getElectDivs($addresses);

        return view('contacts.add', [
            'users' => User::orderBy('created_at', 'asc')->get(),
            'addresses' => $addresses,
            'electDivs' => $electDivs,
        ]);
    }

    public function editContact(Request $request, Contact $contact) {
        return view('contacts.add', [
            'contact' => $contact,
        ]);
    }

    public function store(Request $request) {
        if( is_numeric( $request->user_id ) == false){
            $name = explode(" ", $request->user_id);
            $user = User::where('email', '=', $name[0].$name[1]."@example.com")->first();
            if ($user === null){
                $user = new User();
                $user->first_name = $name[0];
                if (count($name) > 1) { $user->last_name = $name[1]; }
                $user->email = $name[0].$name[1]."@example.com";
                $user->save();
            }
        } else {
            $user = User::where('id', '=', $request->user_id )->first();
        }

        $addresses = Address::orderBy('created_at', 'asc')->get();
        $electDivs = $this->getElectDivs($addresses);

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

        $loc = Address::where('id', '=', $request->address )->first();
        if ($loc['address_town'] == '') {
            $loc['address_town'] = $loc["address_st"];
        }

        $sesh = array( "loc" => $loc, "date" => $request->date, 'user' => $user );

        return view('contacts.add', [
            'users' => User::orderBy('created_at', 'asc')->get(),
            'sesh' => $sesh,
            'electDivs' => $electDivs,
        ]);
    }

    public function destroy(Request $request, Contact $contact) {
        $this->authorize('destroy', $contact);
        $contact->delete();
        return redirect('/contacts');
    }


}
