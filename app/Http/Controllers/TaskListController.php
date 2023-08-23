<?php

namespace App\Http\Controllers;

use App\Mail\DeadlineReminder;
use App\Mail\NewTaskAdded;
use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $taskLists = TaskList::where("user_id", $id)
            ->orderBy("deadline", "ASC")
            ->get();

        return view("taskList.index", compact("taskLists"));
    }

    public function finished()
    {
        $id = Auth::user()->id;
        $taskLists = TaskList::where("user_id", $id)
            ->where("status", "finished")
            ->orderBy("deadline", "ASC")
            ->get();
        return view("taskList.finished", compact("taskLists"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $user = Auth::user();
        $taskId = $request->id;
        $task = Task::findOrFail($taskId);

        return view("taskList.create", compact("task"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $taskId = intval($request->task_id);
        $deadline = $request->deadline;
        // $taskList = TaskList::find($taskId);
        $taskList = DB::table("users_tasks")
            ->where("user_id", $userId)
            ->where("task_id", $taskId)
            ->where("deadline", $deadline)
            ->first();

        $recurringTaskList = DB::table("users_recurring_tasks")
            ->where("user_id", $userId)
            ->where("task_id", $taskId)
            ->where("status", "active")
            ->first();

        if ($recurringTaskList) {
            return redirect()
                ->route("tasks.list")
                ->with("success", "This task is already recurring!");
        } elseif ($taskList) {
            return redirect()
                ->route("tasks.list")
                ->with(
                    "success",
                    "The same task with the same deadline already exists in your list!"
                );
        } else {
            $taskList = new TaskList();
            $taskList->user_id = $userId;
            $taskList->task_id = $taskId;
            $taskList->deadline = $request->deadline;

            $taskList->save();
        }

        Mail::to(Auth::user()->email)->send(new NewTaskAdded($taskList));
        return redirect()
            ->route("tasks.list")
            ->with(
                "success",
                "Your task has been successfully added to your list!"
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userId = Auth::user()->id;
        $task = TaskList::where("user_id", $userId)->first();

        return view("taskList.show", compact("task"));
    }

    public function showtasks(string $id)
    {
        $tasks = TaskList::where("user_id", $id)->get();
        $user = User::where("id", $id)->first();

        return view("admin.user.tasklists", compact("tasks", "user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $taskList = TaskList::findOrFail($id);
        $taskList->status = "finished";
        $taskList->save();

        // return view("taskList.index", compact("taskLists"));
        return redirect()
            ->route("tasklists.index")
            ->with("success", "Your task has been successfully finished !");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $taskList = TaskList::findOrFail($id);
        $taskList->delete();
        return redirect()
            ->route("tasklists.index")
            ->with("success", "Your task has been successfully deleted!");
    }
}
