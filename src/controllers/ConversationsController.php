<?php

/**
 * Attention:
 * This is just an example and not for production!
 *
**/
namespace Pichkrement\Messenger\Controllers;

use \Pichkrement\Messenger\Models\User as User;
use \Pichkrement\Messenger\Models\Message as Message;
use \Pichkrement\Messenger\Models\Conversation as Conversation;

class ExampleController extends \BaseController{

    public function info(){

    	$nummsg = Message::count();
    	$numusr = User::count();
    	$numcon = Conversation::count();

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

    	return $return;
    }

}