<?php

use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('announcements')->delete();
        
        \DB::table('announcements')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'title' => 'Dota tournament',
                'description' => 'Manila bay',
                'pdf' => '92dcbace217e28c38838b75fefdde69a.docx',
                'date_post' => '2017-06-12 17:50:13',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}