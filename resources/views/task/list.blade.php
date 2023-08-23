<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-dark dark:text-dark leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session()->has('success'))
            <div class="text-center py-3 bg-green-400 rounded-sm mx-auto">{{ session('success') }}</div>
        @endif


        <div class="mb-2 mx-24">  
          
            <form method="GET"  action="{{ route('tasks.list') }}" >   
                <label for="search" class="mb-2 mx-8 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="search"  name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search task" value="{{ request()->get('search') }}" required>
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>

        <div class="relative overflow-x-auto">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg grid grid-cols-2 gap-2">
                @foreach ($tasks as $task)
                    <div class="bg-slate-400 text-center p-3 rounded-md">
                        <div class="bg-teal-500 rounded-md mb-3 text-left p-4 text-white h-32">
                            <p><span class="text-m">Task name: </span><span
                                    class="font-bold">{{ $task->name }}</span> </p>
                            <p>Task Description {{ $task->description }}</p>
                          
                        </div>
                        <div class="flex justify-around">
                        <form method="get" action="{{ route('tasklists.create') }}">
                           
                       
                            <input type="text" hidden name="id" value="{{ $task->id }}">
                            <x-primary-button>{{ __('Add to tasklist') }}</x-primary-button>
                        </form>

                        <form method="get" action="{{ route('recurringtasklists.create') }}">
                           
                       
                            <input type="text" hidden name="id" value="{{ $task->id }}">
                            <x-primary-button>{{ __('Make recurring') }}</x-primary-button>
                        </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>