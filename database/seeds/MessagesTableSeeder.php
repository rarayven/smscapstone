<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('messages')->delete();
        
        \DB::table('messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'title' => 'Hey',
                'description' => 'Scssss',
                'pdf' => '35d1d788de09bd9483469b692a7e0554.docx',
                'date_created' => '2017-06-12 14:41:09',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 6,
                'title' => 'Safasfa',
                'description' => 'Lols',
                'pdf' => 'b011e6f409c894a9709ca9b4bb4f74a2.docx',
                'date_created' => '2017-06-12 14:47:12',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}