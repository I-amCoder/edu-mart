<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategoryTableSeeder extends Seeder
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
                'name' => 'Public Service Commmission Jobs',
                'description' => 'Here is Description',
            ],
            [
                'name' => 'Police Jobs',
                'description' => 'Here is Description',
            ],
            [
                'name' => 'Police Province and Region Wise Jobs',
                'description' => 'Here is Description',
            ],
            [
                'name' => 'Government Jobs',
                'description' => 'Here is Description',
            ],
            [
                'name' => 'Public Sector Organizations Jobs',
                'description' => 'Here is Description',
            ],
            [
                'name' => 'Oil and Gas Jobs',
                'description' => 'Here is Description',
            ],
            [
                'name' => 'City Wise Jobs',
                'description' => 'Here is Description',
            ],
        ];
        foreach ($data as $cat) {
            DB::table('job_categories')->insert([
                'name' => $cat['name'],
                'description' => $cat['description'],
            ]);
        }
    }
}
