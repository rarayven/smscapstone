<?php

use Illuminate\Database\Seeder;

class AllocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('allocations')->delete();
        
        \DB::table('allocations')->insert(array (
            0 => 
            array (
                'id' => 9,
                'budget_id' => 7,
                'allocation_type_id' => 2,
                'amount' => 300.0,
            ),
            1 => 
            array (
                'id' => 10,
                'budget_id' => 7,
                'allocation_type_id' => 3,
                'amount' => 4000.0,
            ),
            2 => 
            array (
                'id' => 15,
                'budget_id' => 9,
                'allocation_type_id' => 2,
                'amount' => 1000.0,
            ),
            3 => 
            array (
                'id' => 16,
                'budget_id' => 9,
                'allocation_type_id' => 3,
                'amount' => 120.0,
            ),
            4 => 
            array (
                'id' => 21,
                'budget_id' => 12,
                'allocation_type_id' => 2,
                'amount' => 1000.0,
            ),
            5 => 
            array (
                'id' => 22,
                'budget_id' => 12,
                'allocation_type_id' => 3,
                'amount' => 2000.0,
            ),
        ));
        
        
    }
}