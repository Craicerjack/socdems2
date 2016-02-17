<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Address;
use DB;

use Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;

class WalksheetController extends Controller {

    protected $addresses;

    public function __construct() {
        $this->middleware('auth');
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
        $support = array();
        if($request->support1) { array_push($support, $request->support1); }
        if($request->support2) { array_push($support, $request->support2); }
        if($request->support3) { array_push($support, $request->support3); }
        if($request->support4) { array_push($support, $request->support4); }
        if($request->support5) { array_push($support, $request->support5); }
        $addressArray = array();
        $streetsArray = explode(',', $request->streets);
        foreach($streetsArray as $st) {
            $street = array(
                'street' => $st,
                'houses' => array(),
            );
            foreach($this->addresses as $address) {
                if ($st == $address["address_st"]) {
                    $contacts = DB::table('contacts')
                                    ->where('address_id', $address["id"])
                                    ->whereIn('support_lvl', $support)
                                    ->get();
                    $house = array(
                        'house' => $address["address_no"],
                        'contacts' => $contacts,
                    );
                    if( count($house["contacts"]) > 0 ){
                        array_push($street["houses"], $house);
                    }
                }
            }
            array_push($addressArray, $street);
        }
        return view('walksheets.walksheet', [
            'streets' => $addressArray,
        ]);
    }

}
