<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEducationalBackgroundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('educational_backgrounds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('student_detail_user_id', 30)->index('feduc_application_user_id_idx');
			$table->boolean('level')->default(0);
			$table->string('school_name', 50);
			$table->string('date_enrolled', 4);
			$table->string('date_graduated', 4);
			$table->string('awards', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('educational_backgrounds');
	}

}
