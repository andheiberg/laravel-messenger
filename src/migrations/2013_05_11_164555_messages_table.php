<?php

use Illuminate\Database\Migrations\Migration;

class MessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function($table){
			$table->increments('id');
			$table->integer("creator");
			$table->text("content");
			$table->integer('user_id');
			$table->integer('conversation_id');

			// belongs to specific conversation to allow multiple receivers
			$table->integer("conversation");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}