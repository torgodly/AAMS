<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            <div class="flex justify-between">
                <div><h1 class="text-2xl font-semibold text-gray-900">Group: {{ $group->name }}</h1>
                    <div class="text-sm font-medium text-gray-500">{{ $group->description }}</div>
                </div>
                <x-primary-button onclick="location.href='{{route('group.students_add', $group->id)}}';">{{__('Add Students')}}</x-primary-button>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($group->students as $student)
                    <a href="{{route('group.students_add', $group->id)}}"
                       class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="p-6 bg-white border-b border-gray-200 flex flex-col justify-between h-full">
                            <div>
                                <div class="text-xl font-semibold text-gray-900">{{ $student->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ $student->email }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ $student->phone }}</div>
                            </div>
                            <div class="text-sm font-medium text-gray-500">{{ $student->group?->name }}</div>

                        </div>
                    </a>

                @endforeach
            </div>
            {{--            {{ $group->students->links()}}--}}

        </div>
    </div>
</x-app-layout>
