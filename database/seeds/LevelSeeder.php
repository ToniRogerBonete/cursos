<?php

use App\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::firstOrCreate([
            'name' =>'Curso complementar',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso de extensão',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso de graduação bacharelado',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso de graduação licenciatura',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso de graduação tecnólogo',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso latu sensu',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso livre',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso stricto sensu',
        ]);
        Level::firstOrCreate([
            'name' =>'Curso Técnico',
        ]);

    }
}
