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
                'id' => 1,
                'student_detail_user_id' => 5,
                'course_id' => 1,
                'school_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'student_detail_user_id' => 5,
                'course_id' => 1,
                'school_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'student_detail_user_id' => 5,
                'course_id' => 1,
                'school_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'student_detail_user_id' => 6,
                'course_id' => 1,
                'school_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'student_detail_user_id' => 6,
                'course_id' => 1,
                'school_id' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'student_detail_user_id' => 6,
                'course_id' => 1,
                'school_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'student_detail_user_id' => 7,
                'course_id' => 1,
                'school_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'student_detail_user_id' => 7,
                'course_id' => 1,
                'school_id' => 2,
            ),
            8 => 
            array (
                'id' => 9,
                'student_detail_user_id' => 7,
                'course_id' => 1,
                'school_id' => 3,
            ),
            9 => 
            array (
                'id' => 10,
                'student_detail_user_id' => 8,
                'course_id' => 1,
                'school_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'student_detail_user_id' => 8,
                'course_id' => 2,
                'school_id' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'student_detail_user_id' => 8,
                'course_id' => 3,
                'school_id' => 3,
            ),
            12 => 
            array (
                'id' => 13,
                'student_detail_user_id' => 9,
                'course_id' => 1,
                'school_id' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'student_detail_user_id' => 9,
                'course_id' => 1,
                'school_id' => 2,
            ),
            14 => 
            array (
                'id' => 15,
                'student_detail_user_id' => 9,
                'course_id' => 1,
                'school_id' => 3,
            ),
            15 => 
            array (
                'id' => 16,
                'student_detail_user_id' => 10,
                'course_id' => 1,
                'school_id' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'student_detail_user_id' => 10,
                'course_id' => 1,
                'school_id' => 2,
            ),
            17 => 
            array (
                'id' => 18,
                'student_detail_user_id' => 10,
                'course_id' => 1,
                'school_id' => 3,
            ),
            18 => 
            array (
                'id' => 19,
                'student_detail_user_id' => 11,
                'course_id' => 1,
                'school_id' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'student_detail_user_id' => 11,
                'course_id' => 1,
                'school_id' => 2,
            ),
            20 => 
            array (
                'id' => 21,
                'student_detail_user_id' => 11,
                'course_id' => 1,
                'school_id' => 3,
            ),
            21 => 
            array (
                'id' => 22,
                'student_detail_user_id' => 12,
                'course_id' => 1,
                'school_id' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'student_detail_user_id' => 12,
                'course_id' => 1,
                'school_id' => 3,
            ),
            23 => 
            array (
                'id' => 24,
                'student_detail_user_id' => 12,
                'course_id' => 1,
                'school_id' => 2,
            ),
            24 => 
            array (
                'id' => 25,
                'student_detail_user_id' => 13,
                'course_id' => 2,
                'school_id' => 2,
            ),
            25 => 
            array (
                'id' => 26,
                'student_detail_user_id' => 13,
                'course_id' => 3,
                'school_id' => 3,
            ),
            26 => 
            array (
                'id' => 27,
                'student_detail_user_id' => 13,
                'course_id' => 1,
                'school_id' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'student_detail_user_id' => 14,
                'course_id' => 1,
                'school_id' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'student_detail_user_id' => 14,
                'course_id' => 1,
                'school_id' => 2,
            ),
            29 => 
            array (
                'id' => 30,
                'student_detail_user_id' => 14,
                'course_id' => 1,
                'school_id' => 3,
            ),
            30 => 
            array (
                'id' => 31,
                'student_detail_user_id' => 24,
                'course_id' => 1,
                'school_id' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'student_detail_user_id' => 24,
                'course_id' => 2,
                'school_id' => 3,
            ),
            32 => 
            array (
                'id' => 33,
                'student_detail_user_id' => 24,
                'course_id' => 1,
                'school_id' => 2,
            ),
            33 => 
            array (
                'id' => 34,
                'student_detail_user_id' => 25,
                'course_id' => 1,
                'school_id' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'student_detail_user_id' => 25,
                'course_id' => 2,
                'school_id' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'student_detail_user_id' => 25,
                'course_id' => 3,
                'school_id' => 1,
            ),
        ));
        
        
    }
}