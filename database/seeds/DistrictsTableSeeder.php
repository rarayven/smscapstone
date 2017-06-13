<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('districts')->delete();
        
        \DB::table('districts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'District 1',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'District 2',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'District 3',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'District 4',
                'is_active' => 1,
            ),
        ));
        
        
    }
}