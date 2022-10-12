<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ResponseController;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\Task as ResourcesTask;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends ResponseController
{
    // List / Lista de tareas
    public function index()
    {
        $gettasks = Task::get();
        return $this->sendResponse(ResourcesTask::collection($gettasks), 200);
    }
    // Store task / Guardar o almacenar tarea en la DB
    public function store(TaskRequest $request)
    {
        $request->validated();
        $new = Task::create([
            'description' => $request['description'],
            'complete_at' => null,
            'status' => 'Pending',
        ]);
        return $this->sendResponse(new ResourcesTask($new), 'Tarea Agregada', 201);
    }
    // Update Task / Actualizar tarea
    public function update(Task $task, TaskRequest $request)
    {
        $request->validated();
        $task->update([
            'description' => $request['description'],
        ]);
        return $this->sendResponse(new ResourcesTask($task), 'Tarea Actualizada', 200);
    }
    // Complete Task / Completar Tarea
    public function complete_task(Task $task)
    {
        $task->update([
            'complete_at' => Carbon::now(),
            'status' => 'Completed',
        ]);
        return $this->sendResponse(new ResourcesTask($task), 'Tarea Completada con exito', 200);
    }
    // Delete Task / Eliminar tarea
    public function delete(Task $task)
    {
        $task->delete();
        return $this->sendResponse(new ResourcesTask($task), 'Tarea Eliminada', 200);
    }
}
