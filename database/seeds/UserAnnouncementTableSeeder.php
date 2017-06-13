<?php

use Illuminate\Database\Seeder;

class UserAnnouncementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_announcement')->delete();
        
        \DB::table('user_announcement')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 5,
                'announcement_id' => 1,
                'is_read' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 6,
                'announcement_id' => 1,
                'is_read' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 9,
                'announcement_id' => 1,
                'is_read' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 11,
                'announcement_id' => 1,
                'is_read' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 14,
                'announcement_id' => 1,
                'is_read' => 0,
            ),
        ));
        
        
    }
}