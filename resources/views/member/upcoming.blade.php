<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upcoming Classes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 max-w-2xl divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($bookings as $class)
                        <div class="py-6">
                            <div class="flex gap-6 justify-between">
                                <div>
                                    <p class="text-2xl font-bold text-purple-700 dark:text-purple-400">
                                        {{ $class->classType->name }}</p>
                                    <p class="text-sm">{{ $class->instructor->name }}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-lg font-bold">{{ $class->date_time->format('g:i a') }}</p>
                                    <p class="text-sm">{{ $class->date_time->format('jS M') }}</p>
                                </div>
                            </div>
                            <div class="mt-1 text-right">
                                <form method="POST" action="{{ route('booking.destroy', $class->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="px-3 py-1" onclick="return confirm('Are you sure?')">Cancel</x-danger-button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div>
                            <p class="text-gray-800 dark:text-gray-200">You have no upcoming bookings.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
