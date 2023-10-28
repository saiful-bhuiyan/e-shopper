<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivisionInformationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('division_informations')->delete();
        
        \DB::table('division_informations')->insert(array (
            0 => 
            array (
                'id' => 2,
                'country_id' => 1,
                'division_name' => 'চট্টগ্রাম',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 15,
                'country_id' => 1,
                'division_name' => 'অন্যান্য',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-26 10:59:35',
            ),
            2 => 
            array (
                'id' => 16,
                'country_id' => 1,
                'division_name' => 'ঢাকা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 17,
                'country_id' => 1,
                'division_name' => 'সিলেট',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 18,
                'country_id' => 1,
                'division_name' => 'বরিশাল',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 19,
                'country_id' => 1,
                'division_name' => 'রংপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 20,
                'country_id' => 1,
                'division_name' => 'ময়মনসিংহ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 21,
                'country_id' => 1,
                'division_name' => 'রাজশাহী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 22,
                'country_id' => 1,
                'division_name' => 'খুলনা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-07-26 11:00:14',
            ),
        ));
        
        
    }
}