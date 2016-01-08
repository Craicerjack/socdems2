<?php

namespace App\Http\Controllers;

use App\Box;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxRepository;

class BoxController extends Controller {
    /**
     * The task repository instance.
     * @var TaskRepository
     */
    protected $boxes;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(BoxRepository $boxes) {
        $this->middleware('auth');
        $this->boxes = $boxes;
    }

    public function index(Request $request) {
        return view('boxes.index', [
            'boxes' => $this->boxes->getBoxes(),
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        // $request->user()->boxes()->create([
        //     'name' => $request->name,
        // ]);
        $box = new Box([ 'name' => $request->name ]);;
        $box->save();
        return redirect('/boxes');
    }

    public function destroy(Request $request, Box $box) {
        $this->authorize('destroy', $box);
        $box->delete();
        return redirect('/boxes');
    }
}
