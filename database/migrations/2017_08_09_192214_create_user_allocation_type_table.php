<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAllocationTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_allocation_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('f_user_allocation_type_user_id_idx');
			$table->integer('allocation_type_id')->unsigned()->index('f_user_allocation_allocation_type_id_idx');
			$table->unique(['user_id','allocation_type_id'], 'user_allocation_type_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_allocation_type');
	}

}
