<?php
namespace Pichkrement\Messenger\Models;

use Pichkrement\Messenger\Models\Conversation as Conversation;

class User extends \Eloquent implements \Illuminate\Auth\UserInterface, \Illuminate\Auth\Reminders\RemindableInterface {

	protected $guarded = array('id', 'password');

	//enable timestamps
	public $timestamps = true;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'token');

	protected $fillable = array('username', 'firstname', 'surname', 'email', "password", "token");

	public static $rules = array(
		"username" => 'required|min:4|unique:users',
		'surname' => 'Required|Min:3|Max:80',
		'firstname' => 'Required|Min:3|Max:80',
		'email' => 'required|between:3,64|email|unique:users',
		'password' => 'required',
		'token' => 'required|min:3'
	);
		

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}


	public function messages(){
		return $this->hasMany('Pichkrement\Messenger\Models\Message');
	}

	public function conversations()
    {
        return $this->belongsToMany('Pichkrement\Messenger\Models\Conversation');
    }

    // send functions

    /**
     * send
     *
     * send message to receiver
     *
     * @param Pichkrement\Messenger\Models\User $receiver receiver
     * @return boolean
     */
    public function send($receiver, $text, $subject){

    	//test preconditions
    	if(! get_class($user) === 'Pichkrement\Messenger\Models\User')
    		return false;


    	//test if there is an conversation between the two members
    	$con = Conversation::user_filter(array($this, $user));

    	//create new conversation
    	if (is_null($con)){
    		$con = new Conversation;
    		$con->name = $subject;
	    	//link users to conversation
	    	$con->save();

	    	$con->users()->sync(array($user->id, $this->id));
    	}

    	
    	//create new Message and add it to conversation
    	$msg = new Message;
    	$msg->content = $text;
    	$msg->user_id = $this->id;

    	$con->messages()->save($msg);
    	
    	return true;
    }

}