<?php

use Illuminate\Database\Seeder;

class CouncilorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('councilors')->delete();
        
        \DB::table('councilors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'district_id' => 1,
                'first_name' => 'Mark',
                'middle_name' => 'Magdasoc',
                'last_name' => 'Damiano',
                'cell_no' => '11111111111',
                'email' => 'marky@gmail.com',
                'picture' => 'Default.png',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'district_id' => 2,
                'first_name' => 'Maricar',
                'middle_name' => 'Magdasoc',
                'last_name' => 'Damiano',
                'cell_no' => '11111111111',
                'email' => 'car@gmail.com',
                'picture' => 'Default.png',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'district_id' => 2,
                'first_name' => 'Mona',
                'middle_name' => NULL,
                'last_name' => 'Lisa',
                'cell_no' => '11231231231',
                'email' => 'mona@gmail.com',
                'picture' => '89fe7e10d24a9b3c8100231b4cae2bed.jpg',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'district_id' => 1,
                'first_name' => 'Geralds',
                'middle_name' => NULL,
                'last_name' => 'Alvaran',
                'cell_no' => '12312312312',
                'email' => 'alvaran@gmail.com',
                'picture' => '0010a1a11a1bb93afdfe63cf063ab6f4.jpg',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'district_id' => 1,
                'first_name' => 'Ascasca',
                'middle_name' => 'Sachja',
                'last_name' => 'Ncsaasn',
                'cell_no' => '12313132131',
                'email' => 'cmaasi@fsa.com',
                'picture' => 'b819b4de317a0a0deb6ad3763439ccb7.jpg',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'district_id' => 1,
                'first_name' => 'Scassaccsasa',
                'middle_name' => 'Sacascsa',
                'last_name' => 'Sacsac',
                'cell_no' => '12313131312',
                'email' => 'pplss@sg.com',
                'picture' => 'a71b22f7316b725dc68ee099d6e79518.jpg',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'district_id' => 1,
                'first_name' => 'First',
                'middle_name' => 'Mid',
                'last_name' => 'Last',
                'cell_no' => '12313123123',
                'email' => 'email@mcis.com',
                'picture' => '201e7f99ef876239ff684bcb5bddf98f.jpg',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'district_id' => 1,
                'first_name' => 'Pablo',
                'middle_name' => NULL,
                'last_name' => 'Damiano',
                'cell_no' => '12331231231',
                'email' => 'pablo@gmail.com',
                'picture' => 'e69c97a5d0f9d2969f75f1910b27de08.png',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'district_id' => 1,
                'first_name' => 'Marife',
                'middle_name' => 'Magdasoc',
                'last_name' => 'Damiano',
                'cell_no' => '23131313123',
                'email' => 'marife@gmail.com',
                'picture' => 'fe642a016054d3c8ef8d84804afa13bb.jpg',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'district_id' => 2,
                'first_name' => 'Marvin',
                'middle_name' => 'Magdasoc',
                'last_name' => 'Damiano',
                'cell_no' => '23131231313',
                'email' => 'mymiano@gmail.com',
                'picture' => 'de72e378403f51d92bca9a2889508342.jpg',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'district_id' => 1,
                'first_name' => 'Bcaskj',
                'middle_name' => 'Askcjhsajkh',
                'last_name' => 'Lhajhcajkh',
                'cell_no' => '12312312313',
                'email' => 'asasc@sacsa.com',
                'picture' => 'bc097a135e3e0b88d010778699baeb62.png',
                'is_active' => 1,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}