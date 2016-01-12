<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller {
       /**
     * The task repository instance.
     * @var TaskRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(UserRepository $users) {
        $this->middleware('auth');
        $this->users = $users;
    }

    public function index(Request $request) {
        return view('users.index', [
            'users' => $this->users->getUsers(),
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        // $request->user()->users()->create([
        //     'name' => $request->name,
        // ]);
        $user = new User([ 'name' => $request->name ]);;
        $user->save();
        return redirect('/users');
    }

    public function destroy(Request $request, User $user) {
        $this->authorize('destroy', $user);
        $user->delete();
        return redirect('/users.index');
    }
}