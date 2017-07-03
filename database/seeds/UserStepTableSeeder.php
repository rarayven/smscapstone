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
                'user_id' => 6,
                'step_id' => 4,
            ),
            1 => 
            array (
                'user_id' => 14,
                'step_id' => 4,
            ),
            2 => 
            array (
                'user_id' => 24,
                'step_id' => 4,
            ),
        ));
        
        
    }
}