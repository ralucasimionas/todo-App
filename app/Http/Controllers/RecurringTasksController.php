<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecurrentTaskRequest;
use App\Mail\NewRecurrentTaskAdded;
use App\Mail\RecurrentReminder;
use App\Models\RecurringTasks;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RecurringTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $today = date("Y-m-d H:i:s");
        $recurringTaskLists = RecurringTasks::where("user_id", $id)
            ->where("status", "active")
            ->where("finish_date", ">=", $today)
            ->orderBy("updated_at", "DESC")
            ->get();
        return view("recurringTaskList.index", compact("recurringTaskLists"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $user = Auth::user();
        $taskId = $request->id;
        $task = Task::findOrFail($taskId);

        return view("recurringTaskList.create", compact("task"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRecurrentTaskRequest $request)
    {
        $userId = Auth::user()->id;
        $taskId = intval($request->task_id);
        $taskList = RecurringTasks::find($taskId);

        $existingTaskList = DB::table("users_recurring_tasks")
            ->where("user_id", $userId)
            ->where("task_id", $taskId)
            ->where("status", "active")
            ->first();

        $currentTaskList = DB::table("users_tasks")
            ->where("user_id", $userId)
            ->where("task_id", $taskId)
            ->where("status", "in_progress")
            ->first();

        if ($currentTaskList) {
            return redirect()
                ->route("tasks.list")
                ->with(
                    "success",
                    "Your task already exists in the current tasks list!"
                );
        } elseif ($existingTaskList) {
            return redirect()
                ->route("tasks.list")
                ->with("success", "The same recurring task already exists!");
        } else {
            $taskList = new RecurringTasks();
            $taskList->user_id = $userId;
            $taskList->task_id = $taskId;
            $taskList->recurrence = $request->recurrence;
            $taskList->start_date = $request->start_date;
            $taskList->finish_date = $request->finish_date;

            $taskList->save();
        }

        Mail::to(Auth::user()->email)->send(
            new NewRecurrentTaskAdded($taskList)
        );

        return redirect()
            ->route("tasks.list")
            ->with(
                "success",
                "Your task has been successfully made recurring!"
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $userId = Auth::user()->id;
        $recurringTask = RecurringTasks::findOrFail($id);

        return view("recurringTaskList.show", compact("recurringTask"));
    }

    public function showtasks(string $id)
    {
        $tasks = RecurringTasks::where("user_id", $id)->get();
        $user = User::where("id", $id)->first();

        return view("admin.user.tasklists", compact("tasks", "user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRecurrentTaskRequest $request, string $id)
    {
        $task = RecurringTasks::findOrFail($id);
        $task->update($request->validated());
        return redirect()
            ->route("recurringtasklists.index", $task->id)
            ->with(
                "success",
                "Your recurring task has been successfully updated!"
            );
    }

    public function deactivate(string $id)
    {
        $taskList = RecurringTasks::findOrFail($id);
        $taskList->status = "inactive";
        $taskList->save();

        // return view("taskList.index", compact("taskLists"));
        return redirect()
            ->route("recurringtasklists.index")
            ->with("success", "Your task has been successfully deactivated !");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $taskList = RecurringTasks::findOrFail($id);
        $taskList->delete();
        return redirect()
            ->route("recurringtasklists.index")
            ->with(
                "success",
                "Your recurrent task has been successfully deleted!"
            );
    }
}
