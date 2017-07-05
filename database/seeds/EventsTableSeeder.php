<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('events')->delete();
        
        \DB::table('events')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'title' => 'Manila major',
                'description' => 'Yehey',
                'place_held' => 'Moscaqc',
                'date_held' => '2017-07-06',
                'time_from' => '13:15:00',
                'time_to' => '13:30:00',
                'status' => 'Done',
                'deleted_at' => '2017-07-05 19:13:03',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'title' => 'Dota',
                'description' => 'Ascascsacxxxxfs',
                'place_held' => 'Plaza',
                'date_held' => '2017-07-12',
                'time_from' => '07:00:00',
                'time_to' => '18:45:00',
                'status' => 'Done',
                'deleted_at' => '2017-07-05 19:16:35',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 2,
                'title' => 'Dota',
                'description' => 'Ascascsacxxxxfs',
                'place_held' => 'Plazasz',
                'date_held' => '2017-07-12',
                'time_from' => '07:00:00',
                'time_to' => '18:45:00',
                'status' => 'Ongoing',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 2,
                'title' => 'Cxcxax',
                'description' => 'Caacx',
                'place_held' => 'Xaxca',
                'date_held' => '2017-07-05',
                'time_from' => '00:00:00',
                'time_to' => '18:45:00',
                'status' => 'Ongoing',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}