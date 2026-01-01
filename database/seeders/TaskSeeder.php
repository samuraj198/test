<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['id' => 1, 'title' => 'Test task 1', 'description' => 'Description 1'],
            ['id' => 2, 'title' => 'Test task 2', 'description' => 'Description 2'],
            ['id' => 3, 'title' => 'Test task 3', 'description' => 'Description 3'],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
