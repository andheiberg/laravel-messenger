#Laravel Messenger
Basic Messaging System for Laravel4

## Introduction
The main purpose of this package is providing an suited Foundation for extended communication platforms, based on laravel 4 (or compatible frameworks).

##Overview
You have many users and they want to chat? Couldn't be simplier!

* Participants have many conversations
* A conversation belongs to many participants
* A message belongs to a single conversation
* A conversation consists of many Messages
* Participants latest read timestamp is stored

##Installation

* Add `"andheiberg/messenger": "dev-master"` to your composer.json
* Run `composer update`
* Add `'Andheiberg\Messenger\MessengerServiceProvider',` to `app/config/app.php` under `providers`
* Run `php artisan messenger:setup`
* Add `use \Andheiberg\Messenger\Traits\UserCanMessage;` inside your User model class

## Usage

Congratulations! Now you can use the laravel4 messenger.

`php artisan messenger:setup` will publish a Conversation and a Message model to app/models. If you prefer to make them your self, just extend Pichkrement\Messenger\Models\Conversation and Pichkrement\Messenger\Models\Message.

### Examples
Now you can use it like a pro.

```php
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
```

