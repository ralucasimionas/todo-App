<x-app-layout>
    <x-slot name="header">
        <h2 class="mb-4 text-2xl font-boldbold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-3xl dark:text-dark">
            {{ __($user->name) }}'s task list:
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session()->has('success'))
            <div class="text-center py-3 bg-green-400 rounded-sm mx-auto">{{ session('success') }}</div>
        @endif

       
        <h1 class="text-4xl font-extrabold dark:text-dark text-center mb-8">Tasks in progress:</h1>
        <div class="relative overflow-x-auto mb-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-center">
                    <table class="w-full text-md text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-blue-300">
                                    Task ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Deadline
                                </th>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            @if ($task->status === "in_progress")
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                                        <a >{{ $task->id }}</a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $task->task->name  }} <span class="font-bold"></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->task->description}} 
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->deadline }}
                                    </td>
                                    <td class="flex justify-evenly">
                                   
                                </td>
                                </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h1 class="text-4xl font-extrabold dark:text-dark text-center mb-8">Finished tasks:</h1>
        <div class="relative overflow-x-auto mb-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-center">
                    <table class="w-full text-md text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-blue-300">
                                    Task ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Deadline
                                </th>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            @if ($task->status === "finished")
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                                        <a >{{ $task->id }}</a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $task->task->name  }} <span class="font-bold"></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->task->description}} 
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->deadline }}
                                    </td>
                                    <td class="flex justify-evenly">
                                   
                                </td>
                                </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h1 class="text-4xl font-extrabold dark:text-dark text-center mb-8">Recurrent tasks:</h1>
        <div class="relative overflow-x-auto">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-center">
                    <table class="w-full text-md text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-blue-300">
                                    Task ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Description
                                </th>
                                
                                <th scope="col" class="px-6 py-3">
                                   Deadline
                                </th>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            @if ($task->status === "active")
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                                        <a >{{ $task->id }}</a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $task->task->name  }} <span class="font-bold"></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $task->task->description}} 
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        {{ $task->recurrence }}
                                    </td>
                                    <td class="flex justify-evenly">
                                   
                                </td>
                                </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>