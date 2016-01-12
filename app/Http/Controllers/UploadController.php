<?php

namespace App\Http\Controllers;

use App\Box;
use App\Voter;
use App\Address;
use Log;
use File;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getUniqueCode($data) {
        if( empty($value[5]) ? $street = $value[7]." ".$value[9] : $street = $value[7]." ".$value[5] );
    }

    public function createBox($data) {
        $box = new Box();
        $box->name = trim($data[12]);
        $box->district = trim($data[9]);
        $box->constituency = trim($data[13]);
        $box->save();
        return $box;
    }

    public function createAddress($data, $boxId) {
        $address = new Address();
        $address->address_no = trim($data[4]);
        $address->address_st = trim($data[5]);
        $address->address_town = trim($data[6]);
        $address->electoral_div = trim($data[10]);
        $address->electoral_area = trim($data[11]);
        $address->postcode = trim($data[7]);
        $address->eircode = trim($data[8]);
        $address->check = $adcheck;
        $address->box_id = $boxId;
        $address->save();
        return $address;
    }

    public function createVoter($data, $addressId) {
        $voter = new Voter();
        $voter->first_name = trim($data[1]);
        $voter->last_name = trim($data[2]);
        $voter->unique_id = trim($data[1].$data[2].$data[8]);
        $voter->voting_rights = trim($data[3]);
        $voter->address = $addressId;
        $voter->save();
        return $voter;
    }

    public function upload(Request $request) {
        try {
            $filename = $request->file('userfile')->getClientOriginalName();
            $path = public_path();
            $request->file('userfile')->move($path.'/uploads', $filename);
            if ( ($handle = fopen(public_path().'/uploads/'.$filename, 'r')) !== FALSE ) {
                //get rid of first line of csv
                fgetcsv($handle, 10000, ",");
                while ( ($data = fgetcsv($handle, 1000, ',')) !==FALSE ) {

                    // check if box exists - if not create
                    $box = Box::where('name', '=', $data[12])->first();
                    if ($box === null) { $box = createBox($data); }

                    // check if address exists - if not create
                    $adcheck = trim($data[4]).trim($data[5]).trim($data[6]);
                    $address = Address::where('check', '=', $adcheck->first());
                    if ($address === null) { $address = createAddress($data, $box->id); }

                    // check if address exists - if not create
                    if (!Voter::where('unique_id', '=', $data[12])->exists()) { $voter = createVoter($data, $address->id); }
                }
            }
            return redirect('/boxes');

        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            return redirect('/errors.404')
        }
    }
}


