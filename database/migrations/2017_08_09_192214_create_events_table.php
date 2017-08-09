<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('feven_user_id_idx');
			$table->string('title', 20);
			$table->text('description', 65535);
			$table->string('place_held', 45);
			$table->date('date_held');
			$table->time('time_from');
			$table->time('time_to');
			$table->enum('status', array('Ongoing','Cancelled','Done'))->default('Ongoing');
			$table->softDeletes();
			$table->unique(['title','date_held','user_id','status','deleted_at','place_held'], 'event_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
