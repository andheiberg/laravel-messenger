<?php


class Conversation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversations';

	public function messages(){
		return $this->hasMany('Message');
	}

	public function users(){
		return $this->belongsToMany('User');
	}

	
}