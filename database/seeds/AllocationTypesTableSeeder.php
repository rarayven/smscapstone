<?php

use Illuminate\Database\Seeder;

class AllocationTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('allocation_types')->delete();
        
        \DB::table('allocation_types')->insert(array (
            0 => 
            array (
                'id' => 2,
                'description' => 'Tuition',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'description' => 'Gift',
                'is_active' => 1,
            ),
        ));
        
        
    }
}