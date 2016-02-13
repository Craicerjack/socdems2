<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Address;

use Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;

class WalksheetController extends Controller {

    protected $contacts;
    protected $addresses;


    public function __construct(ContactRepository $contacts) {
        $this->middleware('auth');
        $this->contacts = $contacts;
        $this->addresses = Address::all();
    }

    public function getElectDivs($addresses) {
        $electDivs = array();
        foreach ($addresses as $add) {
            array_push($electDivs, $add->electoral_div);
        }
        $electDivs = array_unique($electDivs);
        return $electDivs;
    }

    public function create() {
        $addresses = Address::orderBy('created_at', 'asc')->get();
        $electDivs = $this->getElectDivs($addresses);

        return view('walksheets.create', [
            'electDivs' => $electDivs,
        ]);
    }

    public function generate(Request $request) {
        $addressArray = array();
        $streetsArray = explode(',', $request->streets);
        Log::info($streetsArray);
        foreach($streetsArray as $st) {
            $street = array(
                'street' => $st,
                'houses' => array(),
            );
            foreach($this->addresses as $address) {
                if ($st == $address["address_st"]) {
                    array_push($street["houses"], $address["address_no"]);
                }
            }
            array_push($addressArray, $street);
        }
        return view('walksheets.walksheet', [
            'streets' => $addressArray,
        ]);
    }

}
