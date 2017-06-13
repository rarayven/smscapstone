<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('years')->delete();
        
        \DB::table('years')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'First Year',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Second Year',
                'is_active' => 1,
            ),
        ));
        
        
    }
}