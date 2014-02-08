<?php namespace Pichkrement\Messenger\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Participant extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'participants';

	/**
	 * The attributes that can be set with Mass Assignment.
	 *
	 * @var array
	 */
	protected $fillable = ['conversation_id', 'user_id', 'last_read'];

	/**
	 * Conversation relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function conversation()
	{
		return $this->belongsTo('Models\Conversation');
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

	public function scopeMe($query)
	{
		return $query->where('user_id', '=', \Auth::user()->id);
	}

	public function scopeNotMe($query)
	{
		return $query->where('user_id', '!=', \Auth::user()->id);
	}

}