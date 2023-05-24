<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Results') }}
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
                                            {{ __('name') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Activity') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('presage') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('rank') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('units') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('ahkam') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('fiqh') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('khata') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($scores as $score)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            {{ $score->name }}

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ $score->activity }}/200
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ round(($score->activity / 200) * 100, 2) }}%
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ $score->activity_rank }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ $score->units }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ $score->ahkam }}/100
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ $score->fiqh }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ $score->khata }}
                                                </div>
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
