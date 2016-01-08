<?php

namespace App\Http\Controllers;

use App\Box;
use App\Voter;
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

    public function upload(Request $request) {
        try {
            $filename = $request->file('userfile')->getClientOriginalName();
            $path = public_path();
            $request->file('userfile')->move($path.'/uploads', $filename);
            if ( ($handle = fopen(public_path().'/uploads/'.$filename, 'r')) !== FALSE ) {
                fgetcsv($handle, 10000, ",");
                while ( ($data = fgetcsv($handle, 1000, ',')) !==FALSE ) {
                    // Create Box
                    $box = Box::where('name', '=', $data[12])->first();
                    if ($box === null) {
                        $box = new Box();
                        $box->name = trim($data[12]);
                        $box->district = trim($data[9]);
                        $box->constituency = trim($data[13]);
                        $box->save();
                    }

                    if (!Voter::where('unique_id', '=', $data[12])->exists()) {
                        // Create Voter
                        $voter = new Voter();
                        $voter->first_name = trim($data[1]);
                        $voter->last_name = trim($data[2]);
                        $voter->unique_id = trim($data[1].$data[2].$data[8]);
                        $voter->address_no = trim($data[4]);
                        $voter->address_st = trim($data[5]);
                        $voter->address_town = trim($data[6]);
                        $voter->electoral_div = trim($data[10]);
                        $voter->electoral_area = trim($data[11]);
                        $voter->postcode = trim($data[7]);
                        $voter->eircode = trim($data[8]);
                        $voter->voting_rights = trim($data[3]);
                        $voter->box_id = $box->id;
                        $voter->save();
                    }
                }
            }
            return redirect('/boxes');

        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }
    }
}


