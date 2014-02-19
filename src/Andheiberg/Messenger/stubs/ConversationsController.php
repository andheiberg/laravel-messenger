<?php namespace Controllers;

use Models\User;
use Models\Message;
use Models\Conversation;
use Models\Participant;
use \App;

class ConversationsController extends BaseController {

    /**
     * Create a BaseController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $conversations = Conversation::forUser()->get();

        if ($conversations->isEmpty())
        {
            return Redirect::route('conversations.create');
        }

        return Redirect::route('conversations.show', [$conversations->last()->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $conversations = Conversation::forUser()->orderBy('updated_at', 'desc')->get();

        return View::make('conversations.create', compact('conversations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $conversation = Conversation::create([
            'subject' => $input['subject'],
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::user()->id,
            'body' => $input['message'],
        ]);

        $sender = Participant::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::user()->id
        ]);

        if ($this->input->has('recipient'))
        {
            $recipient = User::where('email', $input['recipient'])->first();
            Participant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $recipient->id,
            ]);
        }

        return Redirect::route('conversations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $conversations = Conversation::forUser()->orderBy('updated_at', 'desc')->get();
        $conversation  = Conversation::find($id);

        // $me = Participant::me()->where('conversation_id', $conversation->id)->first();
        // $me->last_read = new DateTime;
        // $me->save();

        return View::make('conversations.show', compact('conversations', 'conversation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createMessage($conversation)
    {
        return View::make('conversations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeMessage($conversation)
    {
        $message = Message::create([
            'conversation_id' => $conversation,
            'user_id' => $this->auth->user()->id,
            'body' => $this->input->input('message'),
        ]);

        return Redirect::route('conversations.show', $conversation);
    }

}