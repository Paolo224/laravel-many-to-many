<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\storage;
use Faker\Generator as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(faker $faker)
    {

        for ($i = 0; $i < 10; $i++) {
            $NewProject = new Project();
            $NewProject->type_id = Type::inRandomOrder()->first()->id;
            $NewProject->Nome_progetto = $faker->word(3);
            $NewProject->Descrizione_progetto = $faker->paragraph();
            $NewProject->Data_inizio_progetto = $faker->dateTime();
            $NewProject->Data_fine_progetto = $faker->dateTime();
            $NewProject->Immagine = 'default-image.jpg';
            $NewProject->Nome_sviluppatore = $faker->name();
            $NewProject->save();
        }
    }
}
