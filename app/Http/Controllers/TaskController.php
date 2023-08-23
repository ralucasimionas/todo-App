<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::all();

        $taskSearch = $request->get("search");

        if ($taskSearch) {
            $tasks = Task::query()
                ->where("name", "LIKE", "%" . $taskSearch . "%")
                ->get();
        }
        return view("task.index", compact("tasks"));
    }

    public function list(Request $request)
    {
        $tasks = Task::all();

        $taskSearch = $request->get("search");

        if ($taskSearch) {
            $tasks = Task::query()
                ->where("name", "LIKE", "%" . $taskSearch . "%")
                ->get();
        }
        return view("task.list", compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("task.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        if (Task::where("name", $request->name)->exists()) {
            return redirect()
                ->route("tasks.create")
                ->with(
                    "success",
                    "This tasks already exists in your current list!"
                );
        } else {
            Task::create($request->validated());
            return redirect()
                ->route("tasks.create")
                ->with("success", "New task successfully added!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view("task.show", compact("task"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateTaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return redirect()
            ->route("tasks.index", $task->id)
            ->with("success", "Your task has been successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()
            ->route("tasks.index")
            ->with("success", "Your task has been successfully deleted!");
    }
}
