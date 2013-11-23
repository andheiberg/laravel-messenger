<?php
namespace Pichkrement\Messenger\Models;

class Conversation extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversations';

	public static $rules = array(
		"name" => 'required|min:4',
	);

	protected $fillable = array('name');

	public function messages(){
		return $this->hasMany('\Pichkrement\Messenger\Models\Message');
	}

	public function users(){
		return $this->belongsToMany('\Pichkrement\Messenger\Models\User');
	}

	public static function user_filter($users) {
		// TODO test preconditions
		//if(!is_array($users))

		//TODO rewrite
		$ids = array();
		foreach ($users as $u) {
			array_push($ids, $u->id);
		}

		sort($ids);
		
		foreach (self::all() as $c){
			$u_ids = $c->users->lists('id');
			sort ( $u_ids );

			if ($u_ids === $ids)
				return $c;
		}

		return null;
	}

	public function addUser($participantEmails){
		//if only one email convert to array
    	if(is_string($participantEmails)) $participantEmails = array($participantEmails);

    	$friend_ids = array();

    	foreach($participantEmails as $f){
    		$user = User::where('email','=',$f)->first();
    		
    		if (!is_null($user)) $friend_ids[] = $user->id;
    	}

    	\Log::info("adduser: " . implode(' ,', $friend_ids));
 
    	if(count($friend_ids)) $this->users()->attach($friend_ids);
	}

	
}