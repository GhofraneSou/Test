<?php

namespace Database\Seeders;
use Database\Seeders\TaskListsTableSeeder;
use Illuminate\Database\Seeder;
use App\Models\TaskList;

class TaskListsTableSeeder extends Seeder
{
    public function run()
    {
        // Generate fake task lists
        \App\Models\TaskList::factory(50)->create();
    }
}

