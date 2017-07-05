<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAchievementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('achievements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('fachi_user_id_idx');
			$table->text('description', 65535);
			$table->string('place_held', 45);
			$table->date('date_held');
			$table->string('pdf', 50);
			$table->enum('status', array('Accepted','Pending','Declined'))->default('Pending');
			$table->enum('token_process', array('Received','Pending','Cancelled'))->default('Pending');
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
		Schema::drop('achievements');
	}

}
