<?php
namespace Pichkrement\Messenger\Lib;

use \Pichkrement\Messenger\Models\User as User;
use \Pichkrement\Messenger\Models\Message as Message;
use \Pichkrement\Messenger\Models\Conversation as Conversation;

class Helper{

	public static function createRandomUser(){
		$user = new User;
    	$user->username = "randomUserName".date_timestamp_get(date_create()).rand();
    	$user->firstname = "Fancy";
    	$user->surname = "GreatName";
    	$user->password = "somefancypw";
    	$user->email = "crazy@".date_timestamp_get(date_create()).rand().".com";

    	$user->save();

    	return $user;
	}

	public static function removeAll($model){
		foreach ($model as $m){
			$m->delete();
		}
	}







}