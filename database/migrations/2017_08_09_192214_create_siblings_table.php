<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiblingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('siblings', function(Blueprint $table)
		{
			$table->string('student_detail_user_id', 30)->index('fsiblings_application_id_idx');
			$table->string('first_name', 25);
			$table->string('last_name', 25);
			$table->string('date_from', 4);
			$table->string('date_to', 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('siblings');
	}

}
