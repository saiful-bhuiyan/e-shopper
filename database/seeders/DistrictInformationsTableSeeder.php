<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictInformationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('district_informations')->delete();
        
        \DB::table('district_informations')->insert(array (
            0 => 
            array (
                'id' => 2,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'ফেনী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 5,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'নোয়াখালী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 6,
                'country_id' => 1,
                'division_id' => 15,
                'district_name' => 'অন্যান্য',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 7,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'ঢাকা সিটি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 8,
                'country_id' => 1,
                'division_id' => 17,
                'district_name' => 'সিলেট জেলা [আউট সাইড]',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 9,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'চট্টগ্রাম',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 10,
                'country_id' => 1,
                'division_id' => 17,
                'district_name' => 'সুনামগঞ্জ জেলা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 11,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'আউট সাইড',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 12,
                'country_id' => 1,
                'division_id' => 17,
                'district_name' => 'হবিগঞ্জ জেলা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 13,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'ফরিদপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 14,
                'country_id' => 1,
                'division_id' => 17,
                'district_name' => 'মৌলভীবাজার জেলা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 15,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'গাজীপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 16,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'গোপালগঞ্জ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 17,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'কিশোরগঞ্জ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 18,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'মাদারিপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 19,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'মানিকগঞ্জ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 20,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'মুন্সিগঞ্জ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 21,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'নারায়নগঞ্জ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 22,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'নরসিংদী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 23,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'রাজবাড়ী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 24,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'শরিয়তপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 25,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'টাঙ্গাইল',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 26,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'কুমিল্লা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 27,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'কক্সবাজার',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 28,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'ব্রাহ্মণবাড়িয়া',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 29,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'চাঁদপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 30,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'লক্ষ্মীপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 31,
                'country_id' => 1,
                'division_id' => 18,
                'district_name' => 'ঝালকাঠি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 32,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'খাগড়াছড়ি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 33,
                'country_id' => 1,
                'division_id' => 18,
                'district_name' => 'পটুয়াখালী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 34,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'রাঙ্গামাটি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 35,
                'country_id' => 1,
                'division_id' => 18,
                'district_name' => 'পিরোজপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 36,
                'country_id' => 1,
                'division_id' => 2,
                'district_name' => 'বান্দরবান',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 37,
                'country_id' => 1,
                'division_id' => 18,
                'district_name' => 'বরিশাল',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 38,
                'country_id' => 1,
                'division_id' => 18,
                'district_name' => 'ভোলা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 39,
                'country_id' => 1,
                'division_id' => 18,
                'district_name' => 'বরগুনা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 40,
                'country_id' => 1,
                'division_id' => 20,
                'district_name' => 'শেরপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 41,
                'country_id' => 1,
                'division_id' => 20,
                'district_name' => 'ময়মনসিংহ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 42,
                'country_id' => 1,
                'division_id' => 20,
                'district_name' => 'জামালপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 43,
                'country_id' => 1,
                'division_id' => 20,
                'district_name' => 'নেত্রকোণা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 44,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'সিরাজগঞ্জ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 45,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'পাবনা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 46,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'বগুড়া',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 47,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'রাজশাহী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 48,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'নাটোর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 49,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'জয়পুরহাট',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 50,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'চাঁপাইনবাবগঞ্জ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 51,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'নওগাঁ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 52,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'যশোর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 53,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'সাতক্ষীরা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 54,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'মেহেরপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 55,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'নড়াইল',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 56,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'চুয়াডাঙ্গা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 57,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'কুষ্টিয়া',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 58,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'দিনাজপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 59,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'মাগুরা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 60,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'নীলফামারী',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 61,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'গাইবান্ধা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 62,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'খুলনা',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 63,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'লালমনিরহাট',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 64,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'ঠাকুরগাও',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 65,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'বাগেরহাট',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 66,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'কুড়িগ্রাম',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 67,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'ঝিনাইদহ',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 68,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'পঞ্চগড়',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 69,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'ঢাকা সিটি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 70,
                'country_id' => 1,
                'division_id' => 19,
                'district_name' => 'রংপুর',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 71,
                'country_id' => 1,
                'division_id' => 22,
                'district_name' => 'খুলনা সিটি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 72,
                'country_id' => 1,
                'division_id' => 21,
                'district_name' => 'রাজশাহী সিটি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 73,
                'country_id' => 1,
                'division_id' => 17,
                'district_name' => 'সিলেট সিটি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 74,
                'country_id' => 1,
                'division_id' => 2,
            'district_name' => 'চট্টগ্রাম (সিটি)',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 75,
                'country_id' => 1,
                'division_id' => 16,
                'district_name' => 'অল ঢাকা সিটি',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}