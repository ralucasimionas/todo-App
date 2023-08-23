<h1>Hello, {{ $taskList->user->name }} !</h1>
<br>
<p>The task `{{ $taskList->task->name }}` has been added to your list.</p>
<p>The task is due on {{ $taskList->deadline }}.</p>
<br>
<p>Don't forget to finish it on time!</p>