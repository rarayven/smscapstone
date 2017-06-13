<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('courses')->delete();
        
        \DB::table('courses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'BSIT',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'BSCS',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'HRDM',
                'is_active' => 1,
            ),
        ));
        
        
    }
}