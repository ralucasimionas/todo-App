<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black text-center dark:text-blackleading-tight">
            {{ __($task->name) }}
        </h2>
    </x-slot>
    @if (session()->has('success'))
        <div class="text-center py-3 bg-green-400 rounded-sm">{{ session('success') }}</div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-white-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('tasks.update', $task->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div class="mt-3">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="$task->name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                :value="old('description', $task->description)" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>


                        <x-primary-button>{{ __('Edit task') }}</x-primary-button>

                    </form> 

                    <form method="post" action="{{ route('tasks.destroy', $task->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('delete')
                        <x-secondary-button>{{ __('Delete task') }}</x-secondary-button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>