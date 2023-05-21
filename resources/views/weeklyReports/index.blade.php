<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reportes
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                                {{ __('Start Date') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('End Date') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('week') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Scores') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($weeklyReports as $weeklyReport)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                                {{ $weeklyReport->start_date }}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-900">
                                                        {{ $weeklyReport->end_date }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-900">
                                                        {{ __(Carbon\Carbon::parse($weeklyReport->start_date)->locale('ar')->weekOfMonth) }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <x-primary-button
                                                        onclick="location.href='{{ route('weeklyReport.edit', ['MonthlyReport' => $monthlyReport->start_date, 'WeeklyReport' => $weeklyReport->end_date]) }}'">
                                                        {{ __('Edit Scores') }}
                                                    </x-primary-button>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <x-primary-button
                                                        onclick="location.href='{{ route('weeklyReport.show', ['MonthlyReport' => $monthlyReport->start_date, 'WeeklyReport' => $weeklyReport->end_date]) }}'">
                                                        {{ __('view Scores') }}
                                                    </x-primary-button>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
