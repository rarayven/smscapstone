<?php

use Illuminate\Database\Seeder;

class UserStepTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_step')->delete();
        
        \DB::table('user_step')->insert(array (
            0 => 
            array (
                'user_id' => 14,
                'step_id' => 1,
            ),
            1 => 
            array (
                'user_id' => 14,
                'step_id' => 2,
            ),
            2 => 
            array (
                'user_id' => 6,
                'step_id' => 1,
            ),
            3 => 
            array (
                'user_id' => 6,
                'step_id' => 2,
            ),
            4 => 
            array (
                'user_id' => 6,
                'step_id' => 3,
            ),
        ));
        
        
    }
}