<?php

use Illuminate\Database\Seeder;

class UserAllocationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_allocation')->delete();
        
        \DB::table('user_allocation')->insert(array (
            0 => 
            array (
                'id' => 6,
                'user_id' => 6,
                'allocation_id' => 21,
            ),
            1 => 
            array (
                'id' => 7,
                'user_id' => 6,
                'allocation_id' => 22,
            ),
            2 => 
            array (
                'id' => 8,
                'user_id' => 14,
                'allocation_id' => 21,
            ),
            3 => 
            array (
                'id' => 9,
                'user_id' => 14,
                'allocation_id' => 22,
            ),
            4 => 
            array (
                'id' => 10,
                'user_id' => 24,
                'allocation_id' => 22,
            ),
        ));
        
        
    }
}