<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Groups</h1>
            </div>

            @livewire('group.create')
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($groups as $group)
                    <a href="{{route('groups.show', $group->id)}}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="p-6 bg-white border-b border-gray-200 flex flex-col justify-between h-full">
                            <div>
                                <div class="text-xl font-semibold text-gray-900">{{ $group->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ $group->teacher?->name }}</div>
                            </div>
                            <div class="text-sm font-medium text-gray-500">{{ $group->students?->count() }} students
                            </div>

                        </div>
                    </a>

                @endforeach
            </div>
            {{ $groups->links()}}

        </div>
    </div>
</x-app-layout>
