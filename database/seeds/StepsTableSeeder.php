<?php

use Illuminate\Database\Seeder;

class StepsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('steps')->delete();
        
        \DB::table('steps')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Roll',
                'deadline' => 2,
                'order' => 2,
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Give away',
                'deadline' => 2,
                'order' => 3,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 4,
                'description' => 'Eat',
                'deadline' => 3,
                'order' => 1,
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 5,
                'description' => 'Dive',
                'deadline' => 2,
                'order' => 4,
                'is_active' => 1,
            ),
        ));
        
        
    }
}