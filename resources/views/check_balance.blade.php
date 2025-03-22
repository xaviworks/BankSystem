<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Balance</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-gradient-to-r from-orange-500 to-red-500 shadow-lg p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-white text-2xl font-bold" href="{{ route('bank.index') }}">💳 Bank Users</a>
            <a class="bg-green-600 text-white px-4 py-2 rounded-lg text-lg shadow-md hover:bg-green-700 transition" href="{{ route('bank.index') }}">🔙 Back to List</a>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-4">
                <h3 class="text-2xl font-bold">💰 Check Balance</h3>
            </div>
            
            <div class="p-6">
                <p class="text-lg">Current Balance: <span class="text-green-500 font-bold">{{ $bankUser->balance }} </span></p>
            </div>
        </div>
    </div>

</body>
</html>
