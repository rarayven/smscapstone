<?php

use Illuminate\Database\Seeder;

class RequirementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('requirements')->delete();
        
        \DB::table('requirements')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Dive',
                'type' => 0,
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Swim',
                'type' => 0,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Read',
                'type' => 0,
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'Power',
                'type' => 1,
                'is_active' => 1,
            ),
        ));
        
        
    }
}