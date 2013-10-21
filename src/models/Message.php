<?php
namespace Pichkrement\Messenger\Models;

class Message extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	public function conversation(){
		return $this->belongsTo('Conversation');
	}

	public function user(){
		return $this->belongsTo('User');
	}

}