<?php

use Illuminate\Database\Seeder;

class UserEventTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_event')->delete();
        
        \DB::table('user_event')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 6,
                'event_id' => 3,
                'is_attending' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 14,
                'event_id' => 3,
                'is_attending' => 0,
            ),
            2 => 
            array (
                'id' => 4,
                'user_id' => 24,
                'event_id' => 3,
                'is_attending' => 0,
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 6,
                'event_id' => 4,
                'is_attending' => 0,
            ),
            4 => 
            array (
                'id' => 6,
                'user_id' => 14,
                'event_id' => 4,
                'is_attending' => 0,
            ),
            5 => 
            array (
                'id' => 7,
                'user_id' => 24,
                'event_id' => 4,
                'is_attending' => 0,
            ),
        ));
        
        
    }
}