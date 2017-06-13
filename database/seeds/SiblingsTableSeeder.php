<?php

use Illuminate\Database\Seeder;

class SiblingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('siblings')->delete();
        
        \DB::table('siblings')->insert(array (
            0 => 
            array (
                'student_detail_user_id' => 9,
                'first_name' => 'Asfsafjkg',
                'last_name' => 'Safgjhasfgshx',
                'date_from' => '2131',
                'date_to' => '2424',
            ),
            1 => 
            array (
                'student_detail_user_id' => 12,
                'first_name' => 'Safasfh',
                'last_name' => 'Kjsfhksafh',
                'date_from' => '1231',
                'date_to' => '2113',
            ),
            2 => 
            array (
                'student_detail_user_id' => 14,
                'first_name' => 'Kgfsakhfgash',
                'last_name' => 'Agfkj',
                'date_from' => '1231',
                'date_to' => '1232',
            ),
            3 => 
            array (
                'student_detail_user_id' => 25,
                'first_name' => 'Ascaschag',
                'last_name' => 'Kjhsgcjh',
                'date_from' => '1997',
                'date_to' => '2003',
            ),
        ));
        
        
    }
}