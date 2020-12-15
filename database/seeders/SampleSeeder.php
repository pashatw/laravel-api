<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\SectionRepository;
use DB;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section')->truncate();
        $sectionRepo = new SectionRepository();

        $section = $sectionRepo->create(['section_name' => 'Project X']);
        $section = $sectionRepo->create(['section_name' => 'Groceries']);
    }
}
