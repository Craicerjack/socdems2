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

    public function create() {
        return view('walksheets.create');

    }

}
