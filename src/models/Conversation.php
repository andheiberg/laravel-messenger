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

	/**
	 * user_filter
	 *
	 * get all conversations of given users
	 *
	 * @todo test preconditions
	 * @param array $users
	 * @return 
	 */
	public static function user_filter(array $users) {

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

	/**
	 * addUser
	 *
	 * adds users to this conversation
	 *
	 * @param array $participantEmails list of all participants
	 * @return void
	 */
	public function addUser(array $participantEmails){
    	$friend_ids = array();

    	foreach($participantEmails as $f){
    		$user = User::where('email','=',$f)->first();
    		
    		if (!is_null($user)) $friend_ids[] = $user->id;
    	}
 
    	if(count($friend_ids)) $this->users()->attach($friend_ids);
	}

	
}