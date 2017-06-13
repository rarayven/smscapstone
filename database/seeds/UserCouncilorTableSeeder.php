<?php

use Illuminate\Database\Seeder;

class UserCouncilorTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_councilor')->delete();
        
        \DB::table('user_councilor')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'councilor_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 3,
                'councilor_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 5,
                'councilor_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 6,
                'councilor_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 7,
                'councilor_id' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 8,
                'councilor_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 9,
                'councilor_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 10,
                'councilor_id' => 2,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 11,
                'councilor_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 12,
                'councilor_id' => 2,
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 13,
                'councilor_id' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 14,
                'councilor_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 15,
                'councilor_id' => 3,
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 16,
                'councilor_id' => 4,
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 17,
                'councilor_id' => 5,
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 18,
                'councilor_id' => 6,
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 19,
                'councilor_id' => 7,
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 20,
                'councilor_id' => 8,
            ),
            18 => 
            array (
                'id' => 19,
                'user_id' => 21,
                'councilor_id' => 9,
            ),
            19 => 
            array (
                'id' => 20,
                'user_id' => 22,
                'councilor_id' => 10,
            ),
            20 => 
            array (
                'id' => 21,
                'user_id' => 23,
                'councilor_id' => 11,
            ),
            21 => 
            array (
                'id' => 22,
                'user_id' => 24,
                'councilor_id' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'user_id' => 25,
                'councilor_id' => 4,
            ),
        ));
        
        
    }
}