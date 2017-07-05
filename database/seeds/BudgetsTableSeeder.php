<?php

use Illuminate\Database\Seeder;

class BudgetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('budgets')->delete();
        
        \DB::table('budgets')->insert(array (
            0 => 
            array (
                'id' => 7,
                'user_id' => 2,
                'amount' => 200000.0,
                'budget_per_student' => 1000.0,
                'slot_count' => 200,
                'budget_date' => '2017-07-05 10:28:30',
            ),
            1 => 
            array (
                'id' => 9,
                'user_id' => 2,
                'amount' => 100000.0,
                'budget_per_student' => 1000.0,
                'slot_count' => 100,
                'budget_date' => '2017-07-05 11:04:16',
            ),
            2 => 
            array (
                'id' => 12,
                'user_id' => 2,
                'amount' => 300000.0,
                'budget_per_student' => 3000.0,
                'slot_count' => 100,
                'budget_date' => '2017-07-05 13:50:26',
            ),
        ));
        
        
    }
}