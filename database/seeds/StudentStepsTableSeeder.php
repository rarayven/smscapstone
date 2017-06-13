<?php

use Illuminate\Database\Seeder;

class StudentStepsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_steps')->delete();
        
        \DB::table('student_steps')->insert(array (
            0 => 
            array (
                'user_id' => 6,
                'step_id' => 4,
                'completion_date' => '2017-06-12 14:40:18',
            ),
            1 => 
            array (
                'user_id' => 14,
                'step_id' => 4,
                'completion_date' => '2017-06-12 14:16:39',
            ),
            2 => 
            array (
                'user_id' => 24,
                'step_id' => 4,
                'completion_date' => '2017-06-12 12:52:21',
            ),
        ));
        
        
    }
}