<?php
namespace Pichkrement\Messenger\Models;

class Conversation extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversations';

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

	
}