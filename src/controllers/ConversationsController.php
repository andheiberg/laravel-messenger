<?php
namespace Pichkrement\Messenger\Controllers;

use \Pichkrement\Messenger\Lib\Helper as H;
use \Pichkrement\Messenger\Models\User as User;
use \Pichkrement\Messenger\Models\Message as Message;
use \Pichkrement\Messenger\Models\Conversation as Conversation;

class ConversationsController extends \BaseController{

    public function info(){

    	$nummsg = Message::count();
    	$numusr = User::count();
    	$numcon = Conversation::count();


    	// test

    	// remove all Users
    	H::removeAll(User::all());

    	H::removeAll(Conversation::all());


    	$sender = H::createRandomUser();
    	$rec = H::createRandomUser();

    	$sender->send($rec, "testnachricht");


    	$return = "<html><head></head><body>
    		Messages: $nummsg <br/>
    		Users: $numusr <br/>
    		Konversations: $numcon <br/>";


    		//conversations
    		$return .= "<table>
    		<tr>
    			<td> name </td>
    			<td> number </td>
    			<td> members </td>
    		</tr>";

    		foreach (Conversation::all() as $con){
    			$return .= "<tr>
    				<td> {$con->name}</td>
    				<td> {$con->messages()->count()} </td>
    				<td>  </td>
    			</tr>";
    		}

    		$return .= "</table>";


    		$return .= "
    	</body></html>";

    	return $return; //\View::make('info', array('msgnum' => \Pichkrement\Messenger\Models\Message::count()));
    }

}