<div >
    <div x-data="{ 'AssignGroupModel': false }" x-on:keydown.escape="AssignGroupModel=false">
        <div class="w-full bg-white rounded-lg border shadow-xl  mb-5">
            <div
                class="flex flex-wrap justify-between  text-md font-medium text-center text-gray-500 bg-gray-50 rounded-t-lg border-b border-gray-200">
                <p class="flex gap-2 mr-2  p-4 text-black rounded-tl-lg    border-blue-600 text-md font-bold ">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 group-hover:fill-blue-600 group-focus:fill-blue-600">
                        <path
                            d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z"/>
                        <path
                            d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z"/>
                        <path
                            d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z"/>
                    </svg>

                    {{__('Add Students to'.$group->name)}}

                </p>

            </div>
            <div class="p-4">
                <div class="flex justify-center  gap-5	my-2">
                    <div class="flex items-center  gap-5  ">

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

                    <div class="flex items-center mt-1 mb-2" @click="AssignGroupModel = ! AssignGroupModel">
                        <x-primary-button>{{ __('Assign to the Group') }}</x-primary-button>
                    </div>
                </div>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div
                                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div
                                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table
                                                class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                <tr>

                                                    <th wire:click="OrderBy('name')"
                                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                        {{__('name')}}
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                        Actions
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    class="bg-white divide-y divide-gray-200">
                                                @foreach($students as $student)
                                                    <tr>
                                                        <td
                                                            class="px-6 py-4 whitespace-no-wrap">
                                                            <div
                                                                class="flex items-center">
                                                                <div>
                                                                    <div
                                                                        class="text-sm leading-5 font-medium text-gray-900">
                                                                        {{ $student->name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-no-wrap">


                                                            <input type="checkbox" wire:model="Selected"
                                                                   value="{{ $student->id }}">
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
                                                <th wire:click="OrderBy('relative_name')" scope="col"
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
</div>
