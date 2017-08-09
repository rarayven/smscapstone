<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCouncilorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_councilor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('fconnection_user_id_idx');
			$table->integer('councilor_id')->unsigned()->index('fconnection_councilor_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_councilor');
	}

}
