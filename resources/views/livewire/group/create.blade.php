<div>
    <div class="flex justify-end" x-data="{show: false}">
        <x-primary-button @click="show = true">Create Group</x-primary-button>
        <div x-show="show"  class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6" >
                        <div>
                            <h1 class="text-2xl font-semibold text-gray-900">Create Group</h1>
                        </div>
                        <form action="{{route('groups.store')}}" method="post">
                            @csrf
                            <div>
                                <x-input-label for="name" class="text-md" :value="__('Name')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                                              autocomplete="name"/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="teacher" class="text-md" :value="__('Teacher')"/>
                                <x-select-input label="teacher" name="teacher_id"
                                                class="block mt-1 w-full"
                                                :options="$teachers"/>
                                <x-input-error class="mt-2" :messages="$errors->get('teacher_id')"/>
                            </div>
                            <div class="mt-4">
                                <x-primary-button class="w-full text-center flex justify-center items-center" type="submit" @click='show =false'>{{__('Create')}}</x-primary-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
