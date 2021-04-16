<?php

namespace App\Http\Controllers\API;

use App\Encrpt;
use App\Http\Controllers\Controller;

use App\User;
use App\Message;
use App\Repositories\UserRepository;
use App\Repositories\MessageRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MessageController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * The message repository instance.
     *
     * @var MessageRepository
     */
    protected $messages;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository     $users
     * @param  MessageRepository  $messages
     *
     * @return void
     */
    public function __construct(UserRepository $users, MessageRepository $messages)
    {
        // $this->middleware('auth');

        $this->users = $users;
        $this->messages = $messages;
    }

    /**
     * Display the latest messages for the given user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(User $user)
    {
        $msgs = $this->messages->latestForUser($user);
        foreach ($msgs as $msg){
            $msg->content = $this->dMsg($msg->content);
        }
        return response()->json($msgs);
    }

    /**
     * Display the messages between two users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user1, User $user2)
    {

        $msgs = $this->messages->betweenUsers($user1, $user2);
        foreach ($msgs as $msg){
            $msg->content = $this->dMsg($msg->content);
        }
        return response()->json($msgs);
//        return response()->json($this->messages->betweenUsers($user1, $user2));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'author' => 'required',
            'recipient' => 'required',
            'content' => 'required|max:255',
        ]);

        // create object
        $message = new Message;
        $message->author()->associate($request->get('author'));
        $message->recipient()->associate($request->get('recipient'));
        $message->content = $this->eMsg($request->get('content'));

        // insert to DB
        $this->messages->insert($message);

        return response()->json($message->with([
            'username' => $this->users->getUsernameByID($request->get('author'))
        ]));
    }

    public function eMsg($msg){

        $encrypt = new RSA();
        $enc = new Encrpt;
        $enc->message = $encrypt->generateKeys($msg);
        $enc->n = $encrypt->n;
        $enc->e = $encrypt->e;
        $enc->d = $encrypt->d;
        $enc->save();

        return $enc->id;
    }


    public function dMsg($msg){
        $id = (int)$msg;
        $enc = Encrpt::findorFail($id);
        $encrypt = new RSA();
        $message = $encrypt->Decrypt($enc);
        return $message;
    }

}
