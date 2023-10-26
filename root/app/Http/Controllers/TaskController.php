<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
    }

    public function list()
    {
        return $this->taskService->list();
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            "taskDescription" => "required|string|max:100",
            "taskUserName" => "required|integer",
            "taskCalcTime" => "required|string",
        ]);

        return $this->taskService->create($validated);
    }

    public function edit(Request $request)
    {
        $validated = $request->validate([
            "taskId" => "required|integer",
            "editTaskDescription" => "required|string|max:100",
            "editTaskUserName" => "required|integer",
            "editTaskCalcTime" => "required|string",
        ]);

        return $this->taskService->edit($validated);
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            "taskId" => "required|integer"
        ]);

        return $this->taskService->delete($validated);
    }

    public function status(Request $request)
    {
        $validated = $request->validate([
            "taskId" => "required|integer",
            "selectedStatus" => "required|string",
        ]);

        return $this->taskService->status($validated);
    }
}
