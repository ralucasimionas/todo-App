<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight text-center">
            {{ __('Current Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session()->has('success'))
      <div class="text-center py-3 bg-green-400 rounded-sm">{{ session('success') }}</div>
        @endif

        

        <div class="overflow-x-auto flex justify-center p-4 sm:p-8 bg-white dark:bg-white-800 shadow sm:rounded-lg">
            
            <div class="p-4 sm:p-8 bg-white dark:bg-white-800 shadow sm:rounded-lg ">

                <div class="mb-16 mx-64">  
                    <form method="GET"  action="{{ route('tasks.index') }}" >   
                            <label for="search" class="mb-2 mx-8 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" id="search"  name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search task" value="{{ request()->get('search') }}" required>
                                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>
                        </form>
                    </div>
                <div class="">
                    <table class="table-auto">
                        <thead class="text-lg text-black uppercase bg-green-500 dark:bg-white-700 dark:text-black">
                            <tr>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Task ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Task Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Task Description
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            
                            
                          

                                <tr class="bg-white border-b  text-center dark:bg-white-800 dark:border-gray-700">
                                    <th scope="col"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        <a href={{ route('tasks.show', $task->id) }}>{{ $task->id }}</a>
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ $task->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ $task->description }} 
                                    </td>
                                   
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>