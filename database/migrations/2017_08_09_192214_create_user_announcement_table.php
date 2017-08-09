<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAnnouncementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_announcement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('fk_user_id_idx');
			$table->integer('announcement_id')->unsigned()->index('fk_announcement_id_idx');
			$table->boolean('is_read')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_announcement');
	}

}
