<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_message', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('message_id')->unsigned()->index('frece_message_id_idx');
			$table->string('user_id', 30)->index('frece_user_id_idx');
			$table->boolean('is_read')->default(0);
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_message');
	}

}
