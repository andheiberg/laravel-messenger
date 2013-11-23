<?php
namespace Pichkrement\Messenger\Models;

class Message extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	protected $fillable = array('user_id', 'content','conversation_id');

	public function conversation(){
		return $this->belongsTo('\Pichkrement\Messenger\Models\Conversation');
	}

	public function user(){
		return $this->belongsTo('\Pichkrement\Messenger\Models\User');
	}

}