<?php namespace Andheiberg\Messenger\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config;

class Conversation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversations';

	/**
	 * The attributes that can be set with Mass Assignment.
	 *
	 * @var array
	 */
	protected $fillable = ['subject'];

	/**
	 * Messages relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function messages()
	{
		return $this->hasMany('\Pichkrement\Messenger\Models\Message');
	}

	/**
	 * Participants relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function participants()
	{
		return $this->hasMany('\Pichkrement\Messenger\Models\Participant');
	}

	public function scopeForUser($query, $id = null)
	{
		$id = $id ?: \Auth::user()->id;

		return $query->join('participants', 'conversations.id', '=', 'participants.conversation_id')
		->where('participants.user_id', $id)
		->select('conversations.*');
	}

	public function scopeWithNewMessages($query, $id = null)
	{
		$id = $id ?: \Auth::user()->id;

		return $query->join('participants', 'conversations.id', '=', 'participants.conversation_id')
		->where('participants.user_id', $id)
		->where('conversations.updated_at', '>', \DB::raw('participants.last_read'))
		->select('conversations.*');
	}

	public function participantsString()
	{
		$participantNames = \DB::table('users')
		->join('participants', 'users.id', '=', 'participants.user_id')
		->where('users.id', '!=', \Auth::user()->id)
		->where('participants.conversation_id', $this->id)
		->select(\DB::raw("concat(users.first_name, ' ', users.last_name) as name"))
		->lists('users.name');

		return implode(', ', $participantNames);
	}

	/**
	 * addUser
	 *
	 * adds users to this conversation
	 *
	 * @param array $participantEmails list of all participants
	 * @return void
	 */
	public function addParticipants(array $participants)
	{
		$userModel = Config::get('messenger::user_model');
		$userModel = new $userModel;

		$participant_ids = [];

		if (is_array($participants))
		{
			if (is_numeric($participants[0]))
			{
				$participant_ids = $participants;
			}
			else
			{
				$participant_ids = $userModel->whereIn('email', $participants)->lists('id');
			}
		}
		else
		{
			if (is_numeric($participants))
			{
				$participant_ids = [$participants];
			}
			else
			{
				$participant_ids = $userModel->where('email', $participants)->lists('id');
			}
		}

		if(count($participant_ids))
		{
			foreach ($participant_ids as $user_id)
			{
				Participant::create([
					'user_id' => $user_id,
					'conversation_id' => $this->id,
				]);
			}
		}
	}

}