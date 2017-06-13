<?php

use Illuminate\Database\Seeder;

class AcademicGradingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('academic_gradings')->delete();
        
        \DB::table('academic_gradings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Standard',
                'highest_grade' => '1',
                'lowest_grade' => '5',
                'failing_grade' => '4',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Irregular',
                'highest_grade' => 'A',
                'lowest_grade' => 'E',
                'failing_grade' => 'D',
                'is_active' => 1,
            ),
        ));
        
        
    }
}