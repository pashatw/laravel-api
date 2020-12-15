<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\SectionRepository;
use App\Repositories\TaskRepository;
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
        DB::table('task')->truncate();

        $sectionRepo = new SectionRepository();
        $taskRepo = new TaskRepository();

        $section = $sectionRepo->create(['section_name' => 'Project X']);
        $task = $taskRepo->create(['section_id' => $section->id, 'task_name' => 'Task 1', 'task_state' => 1]);
        $task = $taskRepo->create(['section_id' => $section->id, 'task_name' => 'Task 2', 'task_state' => 2]);
        $section = $sectionRepo->create(['section_name' => 'Groceries']);
        $task = $taskRepo->create(['section_id' => $section->id, 'task_name' => 'Groceries 1', 'task_state' => 1]);
        $task = $taskRepo->create(['section_id' => $section->id, 'task_name' => 'Groceries 2', 'task_state' => 2]);
    }
}
