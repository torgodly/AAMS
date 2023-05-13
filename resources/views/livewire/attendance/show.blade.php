<div>
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
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            name
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            date
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
                                                <div
                                                    class="text-sm leading-5 text-gray-900">
                                                    {{ $student->date }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap">


                                                <input type="checkbox" wire:click="toggleAttendance({{$student->id}}, '{{$student->date}}')" @if($student->is_present) checked @endif">
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div
                                    class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
{{--                                    {{ $attendances->links() }}--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
