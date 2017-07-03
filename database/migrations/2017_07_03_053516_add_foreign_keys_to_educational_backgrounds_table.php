<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEducationalBackgroundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('educational_backgrounds', function(Blueprint $table)
		{
			$table->foreign('student_detail_user_id', 'feduc_application_user_id')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('educational_backgrounds', function(Blueprint $table)
		{
			$table->dropForeign('feduc_application_user_id');
		});
	}

}
