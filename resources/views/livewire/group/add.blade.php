

<div class="py-12" x-data="{ 'AssignGroupModel': false }" x-on:keydown.escape="AssignGroupModel=false">
    <div class="flex justify-center  gap-5	my-2 flex-col md:flex-row">
        <div class="flex items-center justify-center  gap-5  ">

            <label for="table-search" class="sr-only">{{ __('messages.Search') }}</label>
            <div class="relative mt-1 mb-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 " fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model='search' type="text" id="table-search"
                       class="bg-gray-50 border border-gray-300 text-gray-900    text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 md:w-40 pl-10 p-2.5"
                       placeholder="بحث">

            </div>
        </div>

        <div class="flex items-center mt-1 justify-center" @click="AssignGroupModel = ! AssignGroupModel">
            <x-primary-button>{{ __('Assign to the Group') }}</x-primary-button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('name') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                                        {{ $student->name }}

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">
                                                <x-text-input type="checkbox" wire:model="Selected" value="{{ $student->id }}"/>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div
                                class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                {{ $students->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none" x-show="AssignGroupModel" x-on:click.away="AssignGroupModel  = false" x-cloak
         x-transition class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6 w-full">
                    <div class="">
                        <div class="flex  justify-end items-center ">
                            <button @click="AssignGroupModel = ! AssignGroupModel"
                                    class=" flex p-1 items-center justify-center rounded-full bg-gray-200 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>

                            </button>
                        </div>

                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                {{ __('Selected Students') }}

                            </h3>
                            <div class="mt-2">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg ">
                                    <table class="min-w-full divide-y divide-gray-300 ">
                                        <thead class="bg-gray-50 rounded-xl">
                                        <tr>
                                            <th wire:click="OrderBy('name')" scope="col"
                                                class="cursor-pointer py-3.5 pl-4 pr-3 text-center text-md font-semibold text-blue-400 sm:pl-6">
                                                {{__('Name')}}
                                            </th>
                                        </tr>
                                        </thead>

                                        @foreach ($Selected_Students as $Selected_Student)
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr>

                                                <td class="whitespace-nowrap px-3 py-4 text-md text-gray-500">
                                                    {{ $Selected_Student->name }}</td>
                                            </tr>

                                            <!-- More people... -->
                                            </tbody>
                                        @endforeach

                                    </table>
                                </div>

                                <form action="{{route('group.students_add', $group->id)}}" method="post">
                                    @csrf
                                    <div class=" my-5  ">
                                        <div class="  w-full gap-5 justify-evenly my-5">
                                            @foreach ($Selected_Students as $Selected_Student)
                                                <input hidden name="students[]" value="{{ $Selected_Student->id }}">
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mt-5 sm:mt-6">
                                        <x-primary-button type="submit">{{ __('Assign') }}</x-primary-button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
