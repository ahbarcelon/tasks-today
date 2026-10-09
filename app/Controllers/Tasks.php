<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function index(): string
    {
        $model = new TaskModel();
        $tasks = $model->getAllTasksOrderedByDate();

        return view('tasks/index', [
            'title'  => 'All Tasks',
            'tasks'  => $tasks,
            'counts' => $model->countByStatus($tasks),
        ]);
    }
}
