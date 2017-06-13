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
        
        
        
    }
}