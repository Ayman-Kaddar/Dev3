<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $tasks = Task::where("user_id", Auth::user()->id);

        if (isset($request->data)) {
            switch ($request->data) {
                case "0":
                    $tasks = $tasks->where("data", "<", now()->format("Y-m-d"));
                    break;
                case "1":
                    $tasks = $tasks->where("data", "=", now()->format("Y-m-d"));
                    break;
                case "2":
                    $tasks = $tasks->where("data", ">", now()->format("Y-m-d"));
                    break;                    
            }

        }

        $tasks = $tasks->orderBy("data", "ASC")->get();

        $tasks->map(function ($task) {
            $task->data = Carbon::create($task->data)->format("d/m/Y");
        });

        $projects = Project::where("user_id", Auth::user()->id)->get();

        return view("tasks.index", compact("tasks", "projects"));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create([
            "texto" => $request->texto,
            "estado" => 0,
            "data" => $request->data,
            "project_id" => $request->project_id,
            "user_id" => Auth::user()->id,
        ]);

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $projects = Project::where("user_id", Auth::user()->id)->get();
        return view("tasks.edit", compact("task", "projects"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update([
            "texto" => $request->texto,
            "data" => $request->data,
            "project_id" => $request->project_id,
        ]);

        return redirect()->route("tasks.index");
    }

    public function setEstado(Task $task){

        if ($task->estado == 1) {
            $task->estado = 0;
        } else {
            $task->estado = 1;
        }

        $task->update();

        //$task->estado = $task->estado == 1 ? 0 : 1;

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }
}
