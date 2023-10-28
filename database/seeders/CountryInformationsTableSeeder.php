<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountryInformationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('country_informations')->delete();
        
        \DB::table('country_informations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_name' => 'Bangladesh',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-07-26 10:28:35',
                'updated_at' => '2022-07-26 10:28:35',
            ),
            1 => 
            array (
                'id' => 2,
                'country_name' => 'ভারত',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-07-26 10:49:19',
                'updated_at' => '2022-07-26 10:49:19',
            ),
        ));
        
        
    }
}