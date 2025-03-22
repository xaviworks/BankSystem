<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Bank User</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="bg-gradient-to-r from-orange-500 to-red-500 shadow-lg p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-white text-2xl font-bold" href="{{ route('bank.index') }}">💳 Bank Users</a>
            <a class="bg-green-600 text-white px-4 py-2 rounded-lg text-lg shadow-md hover:bg-green-700 transition" href="{{ route('bank.index') }}">🔙 Back to List</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-8">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-4">
                <h3 class="text-2xl font-bold">✏️ Edit Bank User</h3>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <form action="{{ route('bank.update', $bankUser->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="first_name" class="block text-gray-700 font-medium">👤 First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $bankUser->first_name) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Middle Name -->
                    <div class="mb-4">
                        <label for="middle_name" class="block text-gray-700 font-medium">👤 Middle Name</label>
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
                        <label for="balance" class="block text-gray-700 font-medium">💰 Balance</label>
                        <input type="text" id="balance" name="balance" 
                            value="{{ old('balance', $bankUser->balance) }}" 
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" 
                            oninput="validateDecimalInput(this)" required>
                    </div>

                    <script>
                        function validateDecimalInput(input) {
                            // Replace anything that's not a number or a decimal point
                            input.value = input.value.replace(/[^0-9.]/g, '');

                            // Allow only one decimal point
                            if ((input.value.match(/\./g) || []).length > 1) {
                                input.value = input.value.replace(/\.$/, ''); // Remove extra decimals
                            }
                        }
                    </script>



                    <!-- Submit Button -->
                    <div class="mt-6 text-center">
                        <button type="submit" class="w-full py-3 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition">
                            🔄 Update Bank User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
