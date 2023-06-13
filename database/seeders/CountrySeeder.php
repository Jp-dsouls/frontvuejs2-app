<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            /*-------------------------*/
            /* Category: Women Clothes */
            /*-------------------------*/

            /* Dresses */
            [
                'continent'=>'America',
                'country'=>'Peru',
            ],
            [
                'continent'=>'Europa',
                'country'=>'Alemania',
            ],
            [
                'continent'=>'Europa',
                'country'=>'Noruega',
            ],
        ]); 
    }
}
