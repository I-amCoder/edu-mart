<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public $data = [
        [
            'name' => 'Multan',
            'address' => 'Multan Punjab Pakistan',
            'description' => 'Here is the description',
        ],
        [
            'name' => 'Peshawar',
            'address' => 'Peshawar Pakistan',
            'description' => 'Here is the description',
        ],
        [
            'name' => 'Lahore',
            'address' => 'Lahore Punjab Pakistan',
            'description' => 'Here is the description',
        ],
        [
            'name' => 'Bahawalpur',
            'address' => 'Bahawalpur Punjab Pakistan',
            'description' => 'Here is the description',
        ],
        [
            'name' => 'FSD',
            'address' => 'FSD Punjab Pakistan',
            'description' => 'Here is the description',
        ],
    ];
    public function run()
    {
        foreach ($this->data as $board) {
            DB::table('provinces')->insert([
                'name' => $board['name'],
                'description' => $board['description'],
            ]);
        }
    }
}
