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

    public function createAddress($data, $boxId, $adcheck) {
        $address = new Address();
        $address->address_no = trim($data[3]).", ".trim($data[4]);
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

    public function createVoter($data, $addressId, $address) {
        Log::info(array($address, $data[1], $data[2]));
        $voter = new Voter();
        $voter->first_name = trim($data[0]);
        $voter->last_name = trim($data[1]);
        $voter->voting_rights = trim($data[2]);
        $voter->address = $addressId;
        $voter->save();
        $voter->unique_id = $voter->id.trim($data[0]).trim($data[1]).$address;
        $voter->save();
        return $voter;
    }

    public function sortFirstField($firstField) {
        // After exploding the data is in a couple of formats
        // split by spaces
        // 0 => '501 Donal',
        // 0 => '504 Bernard McGlinchey',
        // 0 => '518 Kenneth McTigue P',
        // 0 => '523 Ruadhan O Nidh',
        // 0 => '563 Camille Guimier A',
        // needed to format this to a regular format
        $register_no =array_shift($firstField);
        if (count($firstField) > 2) {
            $last = array_pop($firstField);
            if (strlen($last) > 2) {
                $a = array( 'first_name' => $firstField[0]." ".$firstField[1], 'last_name' => $last );
            } else {
                $a = array( 'first_name' => $firstField[0], 'last_name' => $firstField[1], 'voting_rights' => $last );
            }
        } elseif (count($firstField) > 1) {
            if (strlen($firstField[1]) > 2) {
                $a = array( 'first_name' => $firstField[0], 'last_name' => $firstField[1] );
            } else {
                $a = array( 'first_name' => $firstField[0]." ".$firstField[1] );
            }
        } else {
            $a = array( 'first_name' => $firstField[0], );
        }
        return $a;
    }

    public function upload(Request $request) {
        try {
            $filename = $request->file('userfile')->getClientOriginalName();
            $extension = File::extension($filename);
            $path = public_path();
            $request->file('userfile')->move($path.'/uploads', $filename);
            if ( ($handle = fopen(public_path().'/uploads/'.$filename, 'r')) !== FALSE ) {
                while ( ($data = fgetcsv($handle, 1000, ',')) !==FALSE ) {
                    // Voter
                    // data[0] = first name
                    // data[1] = last name
                    // data[2] = voting rights

                    // addresses
                    // data[3] = house name
                    // data[4] = house number
                    // data[5] = townland
                    // data[6] = qualifier
                    // data[7] = postcode
                    // data[8] = eircode
                    // data[10] = electoral division
                    // data[11] = electoral area

                    // boxes
                    // data[9] = polling district
                    // data[12] = polling station
                    // data[13] = dail constituency
                    // check if box exists - if not create
                    $box = Box::where('name', '=', $data[12])->first();
                    if ($box === null) { $box = $this->createBox($data); }

                    // // check if address exists - if not create
                    $adcheck = trim($data[4]) ." ". trim($data[5]) ." ".trim($data[6]);
                    $address = Address::where('check', '=', $adcheck)->first();
                    if ($address === null) { $address = $this->createAddress($data, $box->id, $adcheck); }

                    // // create voter
                    $voter = $this->createVoter($data, $address->id, $adcheck);
                }
                \Session::flash('flash_message','Upload Complete');
                return view('upload');
            } else {
                return view('errors.404');
            }


            // return redirect('/boxes');

        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            return view('errors.404');
        }
    }
}


