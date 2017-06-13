<?php

use Illuminate\Database\Seeder;

class AchievementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('achievements')->delete();
        
        \DB::table('achievements')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 6,
                'description' => 'Quiz',
                'place_held' => 'Manila',
                'date_held' => '2017-05-28',
                'pdf' => '33fffb6eda851a047411985817bd5e3e.docx',
                'status' => 'Pending',
                'token_process' => 'Pending',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}