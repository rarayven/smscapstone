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
                'title' => 'tiels',
                'short_title' => '231',
                'logo' => '21aasdsa',
                'color' => '123131',
            ),
        ));
        
        
    }
}