<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black text-center dark:text-blackleading-tight text-center">
            {{ __($user->name) }}
        </h2>
    </x-slot>
    @if (session()->has('success'))
        <div class="text-center py-3 bg-green-400 rounded-sm">{{ session('success') }}</div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-white-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('users.update', $user->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div class="mt-3">
                            <x-input-label for="name" :value="__('User name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="$user->name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="email" :value="__('User email')" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full"
                                :value="old('email', $user->email)" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>


                        <x-primary-button>{{ __('Edit user') }}</x-primary-button>

                    </form> 

                    <form method="post" action="{{ route('users.destroy', $user->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('delete')
                        <x-secondary-button>{{ __('Delete user') }}</x-secondary-button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>