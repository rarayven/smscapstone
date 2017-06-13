<?php

use Illuminate\Database\Seeder;

class UserMessageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_message')->delete();
        
        \DB::table('user_message')->insert(array (
            0 => 
            array (
                'id' => 1,
                'message_id' => 1,
                'user_id' => 6,
                'is_read' => 1,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'message_id' => 2,
                'user_id' => 2,
                'is_read' => 0,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}