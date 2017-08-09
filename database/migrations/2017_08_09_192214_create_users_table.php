<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('id', 30)->primary();
			$table->enum('type', array('Admin','Coordinator','Student'))->default('Admin');
			$table->string('first_name', 25);
			$table->string('middle_name', 25)->nullable();
			$table->string('last_name', 25);
			$table->string('email', 30)->unique('email_UNIQUE');
			$table->string('password', 61);
			$table->string('cell_no', 15);
			$table->string('picture', 36)->default('Default.png');
			$table->boolean('is_active')->default(0);
			$table->dateTime('last_login')->nullable();
			$table->string('remember_token', 60)->nullable();
			$table->softDeletes();
			$table->unique(['first_name','middle_name','last_name'], 'username_unique');
		});
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
