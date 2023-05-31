<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl ">
                    <section>
                        @if (session('success'))
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 20000)"
                                class="text-base text-white bg-green-500 w-fit  px-4 py-2 rounded-lg"
                            >{{ __('User created Successfully.') }}</p>

                        @endif

                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('register Account') }}
                            </h2>

                        </header>

                        <form method="post" action="{{ route('register') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Name')"/>
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                              :value="old('name')" required autofocus autocomplete="name"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')"/>
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                              :value="old('email')" required autocomplete="username"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="phone" :value="__('phone')"/>
                                <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone"
                                              :value="old('phone')" required autocomplete="phone"/>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="type" :value="__('type')"/>
                                <x-select-input label="type" name="type"
                                                class="block mt-1 w-full"
                                                :options="['admin' => 'admin', 'Student' => 'Student', 'Teacher' => 'Teacher']"/>
                                <x-input-error :messages="$errors->get('type')" class="mt-2"/>
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')"/>

                                <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password"/>

                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation" required autocomplete="new-password"/>

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                            </div>

                            <x-primary-button class="ml-4">
                                {{ __('Register') }}
                            </x-primary-button>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
