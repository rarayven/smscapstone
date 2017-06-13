<?php

use Illuminate\Database\Seeder;

class CurrentCollegesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('current_colleges')->delete();
        
        \DB::table('current_colleges')->insert(array (
            0 => 
            array (
                'student_detail_user_id' => 5,
                'school_id' => 1,
                'course_id' => 2,
                'gwa' => '1.0',
            ),
            1 => 
            array (
                'student_detail_user_id' => 7,
                'school_id' => 1,
                'course_id' => 2,
                'gwa' => '1.0',
            ),
            2 => 
            array (
                'student_detail_user_id' => 8,
                'school_id' => 1,
                'course_id' => 1,
                'gwa' => '1.0',
            ),
            3 => 
            array (
                'student_detail_user_id' => 12,
                'school_id' => 2,
                'course_id' => 2,
                'gwa' => '1.0',
            ),
            4 => 
            array (
                'student_detail_user_id' => 25,
                'school_id' => 1,
                'course_id' => 1,
                'gwa' => '1',
            ),
        ));
        
        
    }
}