<h1>Hello, {{ $taskList->user->name }} !</h1>
<br>
<p>The task `{{ $taskList->task->name }}`, has been successfully added to your  recurrent list.</p>
<p>The task is due on {{ $taskList->recurrence }} of every month, starting {{ $taskList->start_date }}.</p>
<br>
<p>Don't forget to finish it on time!</p>