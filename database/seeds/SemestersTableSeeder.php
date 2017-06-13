<?php

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('semesters')->delete();
        
        \DB::table('semesters')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'First Sem',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Second Sem',
                'is_active' => 1,
            ),
        ));
        
        
    }
}