<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_event', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('fatte_user_id_idx');
			$table->integer('event_id')->unsigned()->index('fatte_event_id_idx');
			$table->boolean('is_attending')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_event');
	}

}
