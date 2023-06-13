<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'id'=>2,
                'name'=>'project',
                'objetivo'=>'',
                'color'=>'',
                'image'=>'/storage/img/projects/2.jpg',
                'monto'=>10.0,
                'description'=>'Healthy food for your catty pet.',
                'coordenadas' =>'',
                'ubigeo' => '',
                'continent_id'=>1,
                'country_id'=>1,
                'sector_type_id'=>1,
                'sector_id'=>1,
            ],

        ]);
    }
}
