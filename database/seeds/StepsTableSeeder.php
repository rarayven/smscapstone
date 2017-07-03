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
                'is_active' => 1,
                ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Give away',
                'is_active' => 1,
                ),
            2 => 
            array (
                'id' => 4,
                'description' => 'Eat',
                'is_active' => 1,
                ),
            3 => 
            array (
                'id' => 5,
                'description' => 'Dive',
                'is_active' => 1,
                ),
            ));
        
        
    }
}