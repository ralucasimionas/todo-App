<?php

namespace App\Cronjobs;

use App\Mail\RecurrentReminder;
use App\Models\RecurringTasks;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class TaskReminderCron
{
    public function __invoke()
    {
        $this->reminder();
    }
    public function reminder()
    {
        //tot ce tine de reminder

        $tomorrow = Carbon::now()->format("d") + 1;

        $recurrentLists = RecurringTasks::query()
            ->where("status", "active")
            ->get();

        foreach ($recurrentLists as $recurrentList) {
            Mail::to($recurrentList->user->email)->send(
                new RecurrentReminder($recurrentList->task->name)
            );
        }
    }
}
