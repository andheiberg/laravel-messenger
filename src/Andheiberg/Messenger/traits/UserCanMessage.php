<?php namespace Andheiberg\Messenger\Traits;

trait UserCanMessage
{
	/**
	 * User relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function messages()
	{
		return $this->hasMany('Andheiberg\Messenger\Models\Message');
	}

	/**
	 * User relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function conversations()
	{
		return $this->belongsToMany('Andheiberg\Messenger\Models\Conversation', 'participants');
	}

	public function newMessagesCount()
	{
		return count($this->conversationsWithNewMessages());
	}

	public function conversationsWithNewMessages()
	{
		$conversationsWithNewMessages = [];
		$participants = \Andheiberg\Messenger\Models\Participant::where('user_id', $this->id)->lists('last_read', 'conversation_id');

		if ($participants)
		{
			$conversations = \Andheiberg\Messenger\Models\Conversation::whereIn('id', array_keys($participants))->get();

			foreach ($conversations as $conversation)
			{
				if ($conversation->updated_at > $participants[$conversation->id])
				{
					$conversationsWithNewMessages[] = $conversation->id;
				}
			}
		}

		return $conversationsWithNewMessages;
	}
}