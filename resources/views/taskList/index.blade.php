<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-dark dark:text-dark leading-tight">
            {{ __('Current ToDO') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session()->has('success'))
            <div class="text-center py-3 bg-green-400 rounded-sm mx-auto">{{ session('success') }}</div>
        @endif

       

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
                                   Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Deadline
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Actions
                                 </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taskLists as $taskList)
                            @if ($taskList->status === "in_progress")
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                                        <a href={{ route('tasklists.show', $taskList->id) }}>{{ $taskList->id }}</a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $taskList->task->name  }} <span class="font-bold"></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $taskList->task->description}} 
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $taskList->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $taskList->deadline }}
                                    </td>
                                    <td class="flex justify-evenly">
                                   <a href="{{route('tasklists.edit', $taskList->id)}}"class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mark as finished</a>
                                   <a href="{{route('tasklists.delete', $taskList->id)}}" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">Delete</a>
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