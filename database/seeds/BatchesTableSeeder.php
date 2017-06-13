<?php

use Illuminate\Database\Seeder;

class BatchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('batches')->delete();
        
        \DB::table('batches')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Batch 22',
                'is_active' => 1,
            ),
        ));
        
        
    }
}