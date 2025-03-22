<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bank Accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold">Bank Accounts</h3>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Bank Accounts Table -->
                    <table class="min-w-full bg-white shadow-lg rounded-lg">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">First Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Last Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Balance</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bankUsers as $bankUser)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $bankUser->first_name }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $bankUser->last_name }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">${{ number_format($bankUser->balance, 2) }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        <a href="{{ route('bank.edit', $bankUser->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Add New Account Button -->
                    <div class="mt-4">
                        <a href="{{ route('bank.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600">Add New Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
