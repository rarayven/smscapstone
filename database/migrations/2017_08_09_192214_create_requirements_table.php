<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requirements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id', 30)->index('frequirement_user_id_idx');
			$table->string('description', 100);
			$table->boolean('type');
			$table->boolean('is_active')->default(1);
			$table->unique(['description','type','user_id'], 'unique_requirements');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requirements');
	}

}
