<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'site_name' => 'EduMart',
            'site_logo' => 'default_logo.jpg',
            'favicon' => 'default_favicon.png',
            'meta_title' => 'Download Educational Material',
            'meta_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut earum asperiores consequatur ratione repellendus officia consequuntur! Tempora doloremque iusto recusandae voluptates est numquam, eum officiis itaque ratione, earum ab dolores!',
            'keywords' => 'Keyword1, keyword2',
            'copyright_text' => 'Copyright Edumart@2022'

        ]);
    }
}
