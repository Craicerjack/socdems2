<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Address;

use Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WalksheetController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
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

}
