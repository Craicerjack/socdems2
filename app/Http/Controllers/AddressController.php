<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{

    protected $addresses;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(AddressRepository $addresses) {
        $this->middleware('auth');
        $this->addresses = $addresses;
    }

    public function index(Request $request) {
        return view('addresses.index', [
            'addresses' => $this->addresses->getAddresses(),
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        // $request->user()->addresses()->create([
        //     'name' => $request->name,
        // ]);
        $address = new Address([ 'name' => $request->name ]);;
        $address->save();
        return redirect('/addresses');
    }

    public function destroy(Request $request, Address $address) {
        $this->authorize('destroy', $address);
        $address->delete();
        return redirect('/addresses');
    }
}
