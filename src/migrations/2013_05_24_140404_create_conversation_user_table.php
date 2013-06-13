<?php

use Illuminate\Database\Migrations\Migration;

class CreateConversationUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('conversation_user', function($table){
				$table->increments('id');
				$table->integer('user_id');
				$table->integer('conversation_id');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conversation_user');
	}

}