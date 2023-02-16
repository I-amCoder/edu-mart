<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => '6th',
                'type' => 'primary',
                'description' => 'Desc',
            ],
            [
                'name' => '7th',
                'type' => 'primary',
                'description' => 'Desc',
            ],
            [
                'name' => '8th',
                'type' => 'primary',
                'description' => 'Desc',
            ],
            [
                'name' => 'Matric',
                'type' => 'secondary',
                'description' => 'Desc',
            ],
            [
                'name' => 'Intermediate',
                'type' => 'secondary',
                'description' => 'Desc',
            ],
        ];

        foreach ($data as $class) {
            DB::table('classes')->insert([
                'name' => $class["name"],
                'type' => $class["type"],
                'parent_id' => 0,
                'description' => $class["description"],
            ]);
        }
    }
}
