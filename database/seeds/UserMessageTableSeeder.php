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
        
        
        
    }
}