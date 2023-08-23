<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Add a new task') }}
        </h2>
    </x-slot>

    <div class="py-12">
    @if(session()->has('success'))
    <div class='text-center py-3 bg-green-400 mx-10'> {{ session('success')}}</div>
    @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                <form method="post" action="{{ route('tasks.store') }}" class="mt-6 space-y-6">
                @csrf
                    <div class='mt-4'>  
                
                    <x-input-label for="name" :value="__('Task name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
              
                <div class='mt-4'>  
                    <x-input-label for="description" :value="__('Task description')" />
                     <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
              

                


                  <x-primary-button>{{ __('Add task') }}</x-primary-button>

                        
                </form>

                </div>
            </div>

            
        </div>
    </div>
</x-app-layout>
