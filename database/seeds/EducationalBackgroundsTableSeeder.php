<?php

use Illuminate\Database\Seeder;

class EducationalBackgroundsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('educational_backgrounds')->delete();
        
        \DB::table('educational_backgrounds')->insert(array (
            0 => 
            array (
                'student_detail_user_id' => 5,
                'level' => 0,
                'school_name' => 'Almario',
                'date_enrolled' => '2131',
                'date_graduated' => '2314',
                'awards' => NULL,
            ),
            1 => 
            array (
                'student_detail_user_id' => 5,
                'level' => 1,
                'school_name' => 'Raja',
                'date_enrolled' => '3242',
                'date_graduated' => '4242',
                'awards' => NULL,
            ),
            2 => 
            array (
                'student_detail_user_id' => 6,
                'level' => 0,
                'school_name' => 'Safgkajfg',
                'date_enrolled' => '1321',
                'date_graduated' => '2313',
                'awards' => 'Aasfjkafg',
            ),
            3 => 
            array (
                'student_detail_user_id' => 6,
                'level' => 1,
                'school_name' => 'Asfasfa',
                'date_enrolled' => '2131',
                'date_graduated' => '2321',
                'awards' => NULL,
            ),
            4 => 
            array (
                'student_detail_user_id' => 7,
                'level' => 0,
                'school_name' => 'Momo',
                'date_enrolled' => '1232',
                'date_graduated' => '4214',
                'awards' => NULL,
            ),
            5 => 
            array (
                'student_detail_user_id' => 7,
                'level' => 1,
                'school_name' => 'Raja',
                'date_enrolled' => '2321',
                'date_graduated' => '4214',
                'awards' => NULL,
            ),
            6 => 
            array (
                'student_detail_user_id' => 8,
                'level' => 0,
                'school_name' => 'Asgsag',
                'date_enrolled' => '1231',
                'date_graduated' => '2131',
                'awards' => 'Fsjgfasfg',
            ),
            7 => 
            array (
                'student_detail_user_id' => 8,
                'level' => 1,
                'school_name' => 'Sajfkhgasfhg',
                'date_enrolled' => '2131',
                'date_graduated' => '2414',
                'awards' => 'Fsfafa',
            ),
            8 => 
            array (
                'student_detail_user_id' => 9,
                'level' => 0,
                'school_name' => 'Ssafasgfshkg',
                'date_enrolled' => '2112',
                'date_graduated' => '2414',
                'awards' => 'Ksjfjshf',
            ),
            9 => 
            array (
                'student_detail_user_id' => 9,
                'level' => 1,
                'school_name' => 'Fakfshsakl',
                'date_enrolled' => '2131',
                'date_graduated' => '2414',
                'awards' => NULL,
            ),
            10 => 
            array (
                'student_detail_user_id' => 10,
                'level' => 0,
                'school_name' => 'Asfhasgfhj',
                'date_enrolled' => '2131',
                'date_graduated' => '2141',
                'awards' => NULL,
            ),
            11 => 
            array (
                'student_detail_user_id' => 10,
                'level' => 1,
                'school_name' => 'Lsfhaskfhj',
                'date_enrolled' => '1212',
                'date_graduated' => '2142',
                'awards' => NULL,
            ),
            12 => 
            array (
                'student_detail_user_id' => 11,
                'level' => 0,
                'school_name' => 'Asfaghxghq',
                'date_enrolled' => '1231',
                'date_graduated' => '1232',
                'awards' => 'Afhjsafhjkg',
            ),
            13 => 
            array (
                'student_detail_user_id' => 11,
                'level' => 1,
                'school_name' => 'Asfasfksafhajxfha',
                'date_enrolled' => '2131',
                'date_graduated' => '2421',
                'awards' => 'Lksfhasfjh',
            ),
            14 => 
            array (
                'student_detail_user_id' => 12,
                'level' => 0,
                'school_name' => 'Asfasfgashfg',
                'date_enrolled' => '2131',
                'date_graduated' => '4124',
                'awards' => 'Safhjgasfgh',
            ),
            15 => 
            array (
                'student_detail_user_id' => 12,
                'level' => 1,
                'school_name' => 'Asfjgasfhg',
                'date_enrolled' => '2131',
                'date_graduated' => '2141',
                'awards' => 'Asfasfasfsafsa',
            ),
            16 => 
            array (
                'student_detail_user_id' => 13,
                'level' => 0,
                'school_name' => 'Asfasfhg',
                'date_enrolled' => '2322',
                'date_graduated' => '4242',
                'awards' => NULL,
            ),
            17 => 
            array (
                'student_detail_user_id' => 13,
                'level' => 1,
                'school_name' => 'Sfasfgaskfhgh',
                'date_enrolled' => '1231',
                'date_graduated' => '2141',
                'awards' => NULL,
            ),
            18 => 
            array (
                'student_detail_user_id' => 14,
                'level' => 0,
                'school_name' => 'Asfjkhfhjk',
                'date_enrolled' => '2312',
                'date_graduated' => '2414',
                'awards' => 'Askfjhasjfh',
            ),
            19 => 
            array (
                'student_detail_user_id' => 14,
                'level' => 1,
                'school_name' => 'Safljkhasjfk',
                'date_enrolled' => '2313',
                'date_graduated' => '4214',
                'awards' => 'Sfafas',
            ),
            20 => 
            array (
                'student_detail_user_id' => 24,
                'level' => 0,
                'school_name' => 'Safsafsa',
                'date_enrolled' => '1232',
                'date_graduated' => '1234',
                'awards' => 'Csacsakjcsahg',
            ),
            21 => 
            array (
                'student_detail_user_id' => 24,
                'level' => 1,
                'school_name' => 'Asfsafkj',
                'date_enrolled' => '2131',
                'date_graduated' => '3123',
                'awards' => 'Cjagkshcjksh',
            ),
            22 => 
            array (
                'student_detail_user_id' => 25,
                'level' => 0,
                'school_name' => 'Scacascgkj',
                'date_enrolled' => '1997',
                'date_graduated' => '2014',
                'awards' => 'Ascascasc',
            ),
            23 => 
            array (
                'student_detail_user_id' => 25,
                'level' => 1,
                'school_name' => 'Ascascas',
                'date_enrolled' => '1997',
                'date_graduated' => '2005',
                'awards' => 'Ascascasca',
            ),
        ));
        
        
    }
}