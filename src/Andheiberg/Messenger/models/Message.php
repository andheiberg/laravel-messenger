<?php namespace Andheiberg\Messenger\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config;

class Message extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	/**
	 * The relationships that should be touched on save.
	 *
	 * @var array
	 */
	protected $touches = ['conversation'];

	/**
	 * The attributes that can be set with Mass Assignment.
	 *
	 * @var array
	 */
	protected $fillable = ['conversation_id', 'user_id', 'body'];

	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	protected $rules = [
		'body' => 'required',
	];

	/**
	 * Conversation relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function conversation()
	{
		return $this->belongsTo('Andheiberg\Messenger\Models\Conversation');
	}

	/**
	 * User relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function user()
	{
		return $this->belongsTo(Config::get('messenger::user_model'));
	}

}