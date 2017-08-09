<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnouncementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('announcements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('fanno_user_id_idx');
			$table->string('title', 45);
			$table->text('description', 65535);
			$table->string('pdf', 50)->nullable();
			$table->dateTime('date_post');
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
		Schema::drop('announcements');
	}

}
