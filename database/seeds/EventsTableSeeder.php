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
                'title' => 'Event',
                'description' => 'Racso',
                'place_held' => 'Plza',
                'date_held' => '2017-06-15',
                'time_from' => '04:00:00',
                'time_to' => '05:00:00',
                'status' => 'Ongoing',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}