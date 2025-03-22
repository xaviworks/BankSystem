<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Bank Account') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-2xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-4">
                <h3 class="text-2xl font-bold">✏️ Update Bank Account</h3>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <form action="{{ route('bank.update', $bankUser->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="first_name" class="block text-gray-700 font-medium">👤 First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $bankUser->first_name) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Middle Name -->
                    <div class="mb-4">
                        <label for="middle_name" class="block text-gray-700 font-medium">🧑‍🦱 Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name', $bankUser->middle_name) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4">
                        <label for="last_name" class="block text-gray-700 font-medium">👤 Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $bankUser->last_name) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Occupation -->
                    <div class="mb-4">
                        <label for="occupation" class="block text-gray-700 font-medium">💼 Occupation</label>
                        <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $bankUser->occupation) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Balance -->
                    <div class="mb-4">
                        <label for="balance" class="block text-gray-700 font-medium">💵 Balance</label>
                        <input type="number" id="balance" name="balance" value="{{ old('balance', $bankUser->balance) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 text-center">
                        <button type="submit" class="w-full py-3 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition">
                            🔄 Update Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
