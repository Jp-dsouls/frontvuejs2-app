<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sector_types')->insert([
            /*-------------------------*/
            /* Category: Women Clothes */
            /*-------------------------*/

            /* Dresses */
            [
                'name'=>'Nacional',
            ],
            [
                'name'=>'Particular',
            ],       
            
        ]); 
    }
}
