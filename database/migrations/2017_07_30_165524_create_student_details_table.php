<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_details', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index('fapplication_user_id_idx');
			$table->integer('barangay_id')->unsigned()->index('fapplication_barangay_id_idx');
			$table->integer('batch_id')->unsigned()->index('fapplication_batch_id_idx');
			$table->integer('district_id')->unsigned()->index('fapplication_district_id_idx');
			$table->integer('school_id')->unsigned()->index('fschool_id_idx');
			$table->integer('course_id')->unsigned()->index('fcourse_id_idx');
			$table->string('house_no', 4);
			$table->string('street', 25);
			$table->date('birthday');
			$table->string('birthplace', 25);
			$table->string('religion', 50);
			$table->boolean('gender')->default(0);
			$table->boolean('brothers')->default(0);
			$table->boolean('sisters')->default(0);
			$table->dateTime('application_date');
			$table->text('essay', 65535);
			$table->text('remarks', 65535)->nullable();
			$table->enum('application_status', array('Accepted','Declined','Pending'))->default('Pending');
			$table->enum('student_status', array('Graduated','Forfeit','Continuing'))->default('Continuing');
			$table->boolean('is_renewal')->default(0);
			$table->boolean('is_steps_done')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_details');
	}

}
