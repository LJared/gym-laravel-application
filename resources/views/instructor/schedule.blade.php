<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule a Class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('schedule.store') }}" method="post" class="max-w-lg">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="text-sm text-gray-700 dark:text-gray-300">Select type of class</label>
                                <select name="class_type_id" class="block mt-2 w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-0 focus:border-gray-500 dark:focus:border-gray-400">
                                    @foreach ($classTypes as $classType)
                                    <option value="{{ $classType->id }}">{{ $classType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-6">
                                <div class="flex-1">
                                    <label class="text-sm text-gray-700 dark:text-gray-300">Date</label>
                                    <input type="date" name="date" class="block mt-2 w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-0 focus:border-gray-500 dark:focus:border-gray-400" min="{{ date('Y-m-d', strtotime('tomorrow')) }}" value="{{ old('date') }}">
                                </div>
                                <div class="flex-1">
                                    <label class="text-sm text-gray-700 dark:text-gray-300">Time</label>
                                    <select type="time" name="time" class="block mt-2 w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-0 focus:border-gray-500 dark:focus:border-gray-400" value="{{ old('time') }}">
                                        <option value="05:00:00">5 am</option>
                                        <option value="06:00:00">6 am</option>
                                        <option value="07:00:00">7 am</option>
                                        <option value="08:00:00">8 am</option>
                                        <option value="17:00:00">5 pm</option>
                                        <option value="18:00:00">6 pm</option>
                                        <option value="19:00:00">7 pm</option>
                                        <option value="20:00:00">8 pm</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                @error('date_time')
                                <div class="text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <x-primary-button>Schedule</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>