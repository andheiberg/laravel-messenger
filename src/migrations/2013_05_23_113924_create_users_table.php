<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('users')){
			Schema::create('users', function($table){
				$table->increments('id');
				$table->string('username', 30)->unique();
				$table->string('firstname', 30);
				$table->string('surname', 30);
				$table->string('password', 30);
				$table->string('email', 30)->unique();
				$table->timestamps();
			});
		}else{
			if(!Schema::hasColumn('users', 'username')){
				Schema::table('users', function($table){
					$table->string('username', 30)->unique();
				});
			}
			if(!Schema::hasColumn('users', 'firstname')){
				Schema::table('users', function($table){
					$table->string('firstname', 30)->unique();
				});
			}
			if(!Schema::hasColumn('users', 'surname')){
				Schema::table('users', function($table){
					$table->string('surname', 30)->unique();
				});
			}
			if(!Schema::hasColumn('users', 'email')){
				Schema::table('users', function($table){
					$table->string('email', 30)->unique();
				});
			}
			if(!Schema::hasColumn('password', 'email')){
				Schema::table('users', function($table){
					$table->string('password', 30)->unique();
				});
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}