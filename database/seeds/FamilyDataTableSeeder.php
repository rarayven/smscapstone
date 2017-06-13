<?php

use Illuminate\Database\Seeder;

class FamilyDataTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('family_data')->delete();
        
        \DB::table('family_data')->insert(array (
            0 => 
            array (
                'id' => 1,
                'student_detail_user_id' => 5,
                'first_name' => 'Marife',
                'last_name' => 'Damiano',
                'citizenship' => 'Filipino',
                'highest_ed' => 'Highschool',
                'occupation' => 'Housewife',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'student_detail_user_id' => 5,
                'first_name' => 'Pablo',
                'last_name' => 'Damiano',
                'citizenship' => 'Filipino',
                'highest_ed' => 'Highschool',
                'occupation' => 'Driver',
                'monthly_income' => '20,000 - 25,000',
                'member_type' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'student_detail_user_id' => 6,
                'first_name' => 'Fsakjgfkh',
                'last_name' => 'Gasfjgashj',
                'citizenship' => 'Gsafgahjg',
                'highest_ed' => 'Gsafgajg',
                'occupation' => 'Housewife',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'student_detail_user_id' => 6,
                'first_name' => 'Pablo',
                'last_name' => 'Damiano',
                'citizenship' => 'Filipino',
                'highest_ed' => 'Highschool',
                'occupation' => 'Driver',
                'monthly_income' => '30,000 - 35,000',
                'member_type' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'student_detail_user_id' => 7,
                'first_name' => 'Puring',
                'last_name' => 'Ramos',
                'citizenship' => 'Filipino',
                'highest_ed' => 'Highschool',
                'occupation' => 'Sales',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'student_detail_user_id' => 7,
                'first_name' => 'Garry',
                'last_name' => 'Ramos',
                'citizenship' => 'Filipino',
                'highest_ed' => 'Highschool',
                'occupation' => 'Bicycle driver',
                'monthly_income' => '15,000 - 20,000',
                'member_type' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'student_detail_user_id' => 8,
                'first_name' => 'Safsafjsh',
                'last_name' => 'Hsflhaljh',
                'citizenship' => 'Hafksj',
                'highest_ed' => 'Asfhksfhj',
                'occupation' => 'Jjhfjkafjkh',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'student_detail_user_id' => 8,
                'first_name' => 'Asflkssafha',
                'last_name' => 'Asfasfgsh',
                'citizenship' => 'Afkgaskfg',
                'highest_ed' => 'Jjhgasfgh',
                'occupation' => 'Asfgjhksafg',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'student_detail_user_id' => 9,
                'first_name' => 'Safhsafjhcxjkh',
                'last_name' => 'Kjshfjksfj',
                'citizenship' => 'Kkjsfhjkshf',
                'highest_ed' => 'Kjhsafjhsjf',
                'occupation' => 'Ajfhsahfj',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'student_detail_user_id' => 9,
                'first_name' => 'Hagfhg',
                'last_name' => 'Jhsfhjgahj',
                'citizenship' => 'Jhsfhjgh',
                'highest_ed' => 'Agfhagf',
                'occupation' => 'Hxgfha',
                'monthly_income' => '15,000 - 20,000',
                'member_type' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'student_detail_user_id' => 10,
                'first_name' => 'Hjkdshlksdh',
                'last_name' => 'Hjkafgjkshfg',
                'citizenship' => 'Jhsfhfjk',
                'highest_ed' => 'Khafkjahf',
                'occupation' => 'Jhkfgjkahfgh',
                'monthly_income' => '15,000 - 20,000',
                'member_type' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'student_detail_user_id' => 10,
                'first_name' => 'Asfgajkgskjhg',
                'last_name' => 'Gsafjkhsahg',
                'citizenship' => 'Kjsfgjkafgj',
                'highest_ed' => 'Gjsfghjafg',
                'occupation' => 'Jhsfghjfgh',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'student_detail_user_id' => 11,
                'first_name' => 'Hajlkhasfhckl',
                'last_name' => 'Kjhaskfhjsachx',
                'citizenship' => 'Fkafhlj',
                'highest_ed' => 'Kjfhkfh',
                'occupation' => 'Laskfhasfjkh',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'student_detail_user_id' => 11,
                'first_name' => 'Asfhjkasfghkax',
                'last_name' => 'Hkfghjasgf',
                'citizenship' => 'Hgsafjkhgsjg',
                'highest_ed' => 'Gsjfhgasfg',
                'occupation' => 'Safhjgasfhg',
                'monthly_income' => '20,000 - 25,000',
                'member_type' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'student_detail_user_id' => 12,
                'first_name' => 'Askfasfsakfghjkg',
                'last_name' => 'Asfjhfghk',
                'citizenship' => 'Asfhjagfhjkg',
                'highest_ed' => 'Gsafghjkg',
                'occupation' => 'Gashjg',
                'monthly_income' => 'None',
                'member_type' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'student_detail_user_id' => 12,
                'first_name' => 'Gdgaskfghjk',
                'last_name' => 'Hjjagsfhjg',
                'citizenship' => 'Jgafg',
                'highest_ed' => 'Hjskfhg',
                'occupation' => 'Asfasf',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'student_detail_user_id' => 13,
                'first_name' => 'Assfgasfgjfg',
                'last_name' => 'Jhsgfjkhagfhj',
                'citizenship' => 'Asfgasfhga',
                'highest_ed' => 'Jhgasfgasfgh',
                'occupation' => 'Hjagsfhgasfhjg',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'student_detail_user_id' => 13,
                'first_name' => 'Hjfsafhgas',
                'last_name' => 'Hjgasfgsfg',
                'citizenship' => 'Gasfgkasfg',
                'highest_ed' => 'Hjgafhgsahjfg',
                'occupation' => 'Saagjfhakjf',
                'monthly_income' => '20,000 - 25,000',
                'member_type' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'student_detail_user_id' => 14,
                'first_name' => 'Safhsahjlhcaxjh',
                'last_name' => 'Jjhasfhjkasfh',
                'citizenship' => 'Kjshfh',
                'highest_ed' => 'Khaskfhjk',
                'occupation' => 'Hjshfjkh',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'student_detail_user_id' => 14,
                'first_name' => 'Hgfajhgsfkjh',
                'last_name' => 'Gasfhjgjh',
                'citizenship' => 'Khjasfgkjhg',
                'highest_ed' => 'Assfasf',
                'occupation' => 'Ssafasfas',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'student_detail_user_id' => 24,
                'first_name' => 'Csagcsahg',
                'last_name' => 'Jhgsackgkhjg',
                'citizenship' => 'Kjhgsakjhgc',
                'highest_ed' => 'Kjhgsagcjkh',
                'occupation' => 'Gjkhsgchjkg',
                'monthly_income' => 'None',
                'member_type' => 0,
            ),
            21 => 
            array (
                'id' => 22,
                'student_detail_user_id' => 24,
                'first_name' => 'Sachgskhj',
                'last_name' => 'Gcsagjkh',
                'citizenship' => 'Gjhcghj',
                'highest_ed' => 'Gsgcjh',
                'occupation' => 'Gascsa',
                'monthly_income' => '15,000 - 20,000',
                'member_type' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'student_detail_user_id' => 25,
                'first_name' => 'Csaghsgc',
                'last_name' => 'Hgcsagsjhg',
                'citizenship' => 'Jkhgcsajkhgjk',
                'highest_ed' => 'Hgjasgcjhg',
                'occupation' => 'Jkgsacjgashj',
                'monthly_income' => '10,000 - 15,000',
                'member_type' => 0,
            ),
            23 => 
            array (
                'id' => 24,
                'student_detail_user_id' => 25,
                'first_name' => 'Jshcajksh',
                'last_name' => 'Jlhcahcah',
                'citizenship' => 'Jkhcsahj',
                'highest_ed' => 'Hcajshcjkh',
                'occupation' => 'Cklsacj',
                'monthly_income' => '15,000 - 20,000',
                'member_type' => 1,
            ),
        ));
        
        
    }
}