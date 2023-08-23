<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecurringTasksController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Models\RecurringTasks;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

### LOGGED IN ROUTES
Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
    route::resource("/tasks", TaskController::class);
});

### ADMIN ROUTES
Route::middleware(["auth", "admin"])
    ->prefix("/admin")
    ->group(function () {
        Route::resource("/users", ProfileController::class);

        Route::get("/tasklists/{tasklist}", [
            TaskListController::class,
            "showtasks",
        ])->name("tasklists.showtasks");

        Route::get("/recurrenttasklists/{tasklist}", [
            TaskListController::class,
            "showtasks",
        ])->name("recurrenttasklists.showtasks");
    });

### USER ROUTES
Route::middleware(["auth", "user"])
    ->prefix("/user")
    ->group(function () {
        Route::get("/tasklists/delete/{tasklist}", [
            TaskListController::class,
            "delete",
        ])->name("tasklists.delete");

        Route::get("/tasklists/finished/", [
            TaskListController::class,
            "finished",
        ])->name("tasklists.finished");

        Route::get("/recurringtasklists/deactivate/{tasklist}", [
            RecurringTasksController::class,
            "deactivate",
        ])->name("recurringtasklists.deactivate");
        Route::get("/recurringtasklists/delete/{tasklist}", [
            RecurringTasksController::class,
            "delete",
        ])->name("recurringtasklists.delete");
        Route::resource("/tasklists", TaskListController::class);
        Route::resource("/recurringtasklists", RecurringTasksController::class);

        Route::get("/tasks/list", [TaskController::class, "list"])->name(
            "tasks.list"
        );
    });

require __DIR__ . "/auth.php";
