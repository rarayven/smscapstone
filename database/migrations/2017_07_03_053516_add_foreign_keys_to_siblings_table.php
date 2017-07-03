<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSiblingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('siblings', function(Blueprint $table)
		{
			$table->foreign('student_detail_user_id', 'fsiblings_application_user_id')->references('user_id')->on('student_details')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('siblings', function(Blueprint $table)
		{
			$table->dropForeign('fsiblings_application_user_id');
		});
	}

}
