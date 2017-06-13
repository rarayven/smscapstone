<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('grades')->delete();
        
        \DB::table('grades')->insert(array (
            0 => 
            array (
                'id' => 1,
                'student_detail_user_id' => 5,
                'year_id' => 2,
                'semester_id' => 2,
                'pdf' => '41bebc7c311724613268a74eebb79c00.docx',
            ),
            1 => 
            array (
                'id' => 2,
                'student_detail_user_id' => 7,
                'year_id' => 1,
                'semester_id' => 2,
                'pdf' => '2396e89de8ae5ec911eaf41485091393.docx',
            ),
            2 => 
            array (
                'id' => 3,
                'student_detail_user_id' => 8,
                'year_id' => 1,
                'semester_id' => 1,
                'pdf' => '06430258354d6a73690489dc6c507631.docx',
            ),
            3 => 
            array (
                'id' => 4,
                'student_detail_user_id' => 12,
                'year_id' => 2,
                'semester_id' => 1,
                'pdf' => 'e245962a4c5806d06c485d17c9fea75d.docx',
            ),
            4 => 
            array (
                'id' => 5,
                'student_detail_user_id' => 25,
                'year_id' => 2,
                'semester_id' => 1,
                'pdf' => '4fa2c5e92fe4b5e6ca9dd41e9a7c7b94.docx',
            ),
        ));
        
        
    }
}