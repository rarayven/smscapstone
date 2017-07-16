<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'title' => 'ScholarshipMS',
                'logo' => 'Logo.png',
                'year_count' => 5,
                'semester_count' => 2,
                ),
            ));
        
        
    }
}