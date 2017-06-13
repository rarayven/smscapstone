<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('schools')->delete();
        
        \DB::table('schools')->insert(array (
            0 => 
            array (
                'id' => 1,
                'academic_grading_id' => 1,
                'description' => 'PUP',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'academic_grading_id' => 1,
                'description' => 'FEU',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'academic_grading_id' => 1,
                'description' => 'STI',
                'is_active' => 1,
            ),
        ));
        
        
    }
}