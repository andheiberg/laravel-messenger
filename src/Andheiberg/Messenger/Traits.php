<?php namespace Andheiberg\Messenger;

trait UserCanMessage
{
	/**
	 * User relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function messages()
	{
		return $this->hasMany('Pichkrement\Messenger\Models\Message');
	}

	/**
	 * User relationship
	 *
	 * @var \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function conversations()
	{
		return $this->belongsToMany('Pichkrement\Messenger\Models\Conversation');
	}

	public function newMessagesCount()
	{
		return count($this->conversationsWithNewMessages());
	}

	public function conversationsWithNewMessages()
	{
		$conversationsWithNewMessages = [];
		$participants = Participant::where('user_id', $this->id)->lists('last_read', 'conversation_id');

		if ($participants)
		{
			$conversations = Conversation::whereIn('id', array_keys($participants))->get();

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