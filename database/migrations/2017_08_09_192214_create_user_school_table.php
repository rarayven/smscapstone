<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserSchoolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_school', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('f_user_school_user_id_idx');
			$table->integer('school_id')->unsigned()->index('f_user_school_school_id_idx');
			$table->unique(['user_id','school_id'], 'user_school_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_school');
	}

}
