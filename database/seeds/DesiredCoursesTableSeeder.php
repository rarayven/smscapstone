<?php

use Illuminate\Database\Seeder;

class DesiredCoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('desired_courses')->delete();
        
        \DB::table('desired_courses')->insert(array (
            0 => 
            array (
                'student_detail_user_id' => 5,
                'course_id' => 1,
                'school_id' => 1,
            ),
            1 => 
            array (
                'student_detail_user_id' => 5,
                'course_id' => 1,
                'school_id' => 2,
            ),
            2 => 
            array (
                'student_detail_user_id' => 5,
                'course_id' => 1,
                'school_id' => 3,
            ),
            3 => 
            array (
                'student_detail_user_id' => 6,
                'course_id' => 1,
                'school_id' => 1,
            ),
            4 => 
            array (
                'student_detail_user_id' => 6,
                'course_id' => 1,
                'school_id' => 3,
            ),
            5 => 
            array (
                'student_detail_user_id' => 6,
                'course_id' => 1,
                'school_id' => 2,
            ),
            6 => 
            array (
                'student_detail_user_id' => 7,
                'course_id' => 1,
                'school_id' => 1,
            ),
            7 => 
            array (
                'student_detail_user_id' => 7,
                'course_id' => 1,
                'school_id' => 2,
            ),
            8 => 
            array (
                'student_detail_user_id' => 7,
                'course_id' => 1,
                'school_id' => 3,
            ),
            9 => 
            array (
                'student_detail_user_id' => 8,
                'course_id' => 1,
                'school_id' => 1,
            ),
            10 => 
            array (
                'student_detail_user_id' => 8,
                'course_id' => 2,
                'school_id' => 2,
            ),
            11 => 
            array (
                'student_detail_user_id' => 8,
                'course_id' => 3,
                'school_id' => 3,
            ),
            12 => 
            array (
                'student_detail_user_id' => 9,
                'course_id' => 1,
                'school_id' => 1,
            ),
            13 => 
            array (
                'student_detail_user_id' => 9,
                'course_id' => 1,
                'school_id' => 2,
            ),
            14 => 
            array (
                'student_detail_user_id' => 9,
                'course_id' => 1,
                'school_id' => 3,
            ),
            15 => 
            array (
                'student_detail_user_id' => 10,
                'course_id' => 1,
                'school_id' => 1,
            ),
            16 => 
            array (
                'student_detail_user_id' => 10,
                'course_id' => 1,
                'school_id' => 2,
            ),
            17 => 
            array (
                'student_detail_user_id' => 10,
                'course_id' => 1,
                'school_id' => 3,
            ),
            18 => 
            array (
                'student_detail_user_id' => 11,
                'course_id' => 1,
                'school_id' => 1,
            ),
            19 => 
            array (
                'student_detail_user_id' => 11,
                'course_id' => 1,
                'school_id' => 2,
            ),
            20 => 
            array (
                'student_detail_user_id' => 11,
                'course_id' => 1,
                'school_id' => 3,
            ),
            21 => 
            array (
                'student_detail_user_id' => 12,
                'course_id' => 1,
                'school_id' => 1,
            ),
            22 => 
            array (
                'student_detail_user_id' => 12,
                'course_id' => 1,
                'school_id' => 3,
            ),
            23 => 
            array (
                'student_detail_user_id' => 12,
                'course_id' => 1,
                'school_id' => 2,
            ),
            24 => 
            array (
                'student_detail_user_id' => 13,
                'course_id' => 2,
                'school_id' => 2,
            ),
            25 => 
            array (
                'student_detail_user_id' => 13,
                'course_id' => 3,
                'school_id' => 3,
            ),
            26 => 
            array (
                'student_detail_user_id' => 13,
                'course_id' => 1,
                'school_id' => 1,
            ),
            27 => 
            array (
                'student_detail_user_id' => 14,
                'course_id' => 1,
                'school_id' => 1,
            ),
            28 => 
            array (
                'student_detail_user_id' => 14,
                'course_id' => 1,
                'school_id' => 2,
            ),
            29 => 
            array (
                'student_detail_user_id' => 14,
                'course_id' => 1,
                'school_id' => 3,
            ),
            30 => 
            array (
                'student_detail_user_id' => 24,
                'course_id' => 1,
                'school_id' => 1,
            ),
            31 => 
            array (
                'student_detail_user_id' => 24,
                'course_id' => 2,
                'school_id' => 3,
            ),
            32 => 
            array (
                'student_detail_user_id' => 24,
                'course_id' => 1,
                'school_id' => 2,
            ),
            33 => 
            array (
                'student_detail_user_id' => 25,
                'course_id' => 1,
                'school_id' => 1,
            ),
            34 => 
            array (
                'student_detail_user_id' => 25,
                'course_id' => 2,
                'school_id' => 1,
            ),
            35 => 
            array (
                'student_detail_user_id' => 25,
                'course_id' => 3,
                'school_id' => 1,
            ),
        ));
        
        
    }
}