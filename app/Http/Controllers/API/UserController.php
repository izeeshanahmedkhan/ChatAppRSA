<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository     $users
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        // $this->middleware('auth');

        $this->users = $users;
    }
    /**
     * Returns all users except the given user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function contacts(User $user)
    {
        return response()->json($this->users->allExceptUser($user));
    }

    public function AuthRouteAPI(Request $request){
        return $request->user();
    }
}
