<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bank Accounts</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Function to display the corresponding form based on button click
    function showForm(accountId, formType) {
      // Hide all forms for this account first
      document.getElementById(accountId + "-deposit-form").style.display = 'none';
      document.getElementById(accountId + "-withdraw-form").style.display = 'none';
      document.getElementById(accountId + "-transfer-form").style.display = 'none';

      // Show the selected form for this account
      if (formType === 'deposit') {
        document.getElementById(accountId + "-deposit-form").style.display = 'block';
      } else if (formType === 'withdraw') {
        document.getElementById(accountId + "-withdraw-form").style.display = 'block';
      } else if (formType === 'transfer') {
        document.getElementById(accountId + "-transfer-form").style.display = 'block';
      }
    }
  </script>
</head>
<body class="bg-gray-100 font-sans antialiased">

  <!-- Navigation Bar -->
  <nav class="bg-gradient-to-r from-orange-500 to-red-500 shadow-lg p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a class="text-white text-2xl font-bold" href="{{ route('bank.index') }}">💳 BANKING SYSTEM</a>
      <a class="bg-green-600 text-white px-4 py-2 rounded-lg text-lg shadow-md hover:bg-green-700 transition" href="{{ route('bank.create') }}">➕ Add Bank User</a>
    </div>
  </nav>

  <!-- Success and Error Messages -->
  @if(session('success'))
    <div class="container mx-auto mt-4 bg-green-500 text-white py-2 px-6 rounded-lg shadow-lg text-center">
      <p>{{ session('success') }}</p>
    </div>
  @elseif(session('error'))
    <div class="container mx-auto mt-4 bg-red-500 text-white py-2 px-6 rounded-lg shadow-lg text-center">
      <p>{{ session('error') }}</p>
    </div>
  @endif

  <!-- Main Content -->
  <div class="container mx-auto mt-8 px-4">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Bank User Dashboard</h1>

    <!-- Bank Account Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($bankUsers as $user)
        <div class="bg-white rounded-lg shadow-xl p-6 transition-transform transform hover:scale-105 hover:shadow-2xl">
          <div class="bg-gradient-to-r from-green-400 to-blue-500 text-white p-4 rounded-t-lg text-center">
            <h2 class="text-2xl font-semibold">{{ $user->first_name }} {{ $user->last_name }}</h2>
            <p class="text-lg mt-1">Balance: <span class="font-bold">${{ number_format($user->balance, 2) }}</span></p>
          </div>

          <!-- Transaction Buttons -->
          <div class="mt-6 mb-4">
            <button onclick="showForm('{{ $user->id }}', 'withdraw')" class="w-full bg-red-500 text-white py-2 rounded-lg font-semibold hover:bg-red-600 transition-all mb-2">Withdraw</button>
            <button onclick="showForm('{{ $user->id }}', 'deposit')" class="w-full bg-green-500 text-white py-2 rounded-lg font-semibold hover:bg-green-600 transition-all mb-2">Deposit</button>
            <button onclick="showForm('{{ $user->id }}', 'transfer')" class="w-full bg-blue-500 text-white py-2 rounded-lg font-semibold hover:bg-blue-600 transition-all">Transfer</button>
          </div>

          <!-- Withdraw Form -->
          <div id="{{ $user->id }}-withdraw-form" style="display:none;" class="mt-4">
            <div class="border border-gray-300 p-4 rounded-lg">
              <h3 class="font-semibold text-lg text-gray-800 mb-2">Withdraw</h3>
              <form action="{{ route('bank.withdraw', $user->id) }}" method="POST">
                @csrf
                <input type="number" name="amount" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Amount to Withdraw" required min="0.01" step="0.01">
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-lg font-semibold hover:bg-red-600 transition-all mt-2">Withdraw</button>
              </form>
            </div>
          </div>

          <!-- Deposit Form -->
          <div id="{{ $user->id }}-deposit-form" style="display:none;" class="mt-4">
            <div class="border border-gray-300 p-4 rounded-lg">
              <h3 class="font-semibold text-lg text-gray-800 mb-2">Deposit</h3>
              <form action="{{ route('bank.deposit', $user->id) }}" method="POST">
                @csrf
                <input type="number" name="amount" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Amount to Deposit" required min="0.01" step="0.01">
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg font-semibold hover:bg-green-600 transition-all mt-2">Deposit</button>
              </form>
            </div>
          </div>

          <!-- Transfer Form -->
          <div id="{{ $user->id }}-transfer-form" style="display:none;" class="mt-4">
            <div class="border border-gray-300 p-4 rounded-lg">
              <h3 class="font-semibold text-lg text-gray-800 mb-2">Transfer</h3>
              <form action="{{ route('bank.transfer', $user->id) }}" method="POST">
                @csrf
                <input type="number" name="amount" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Amount to Transfer" required min="0.01" step="0.01">
                <select name="recipient_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 mt-2" required>
                  @foreach ($bankUsers as $recipient)
                    @if ($recipient->id != $user->id)
                      <option value="{{ $recipient->id }}">{{ $recipient->first_name }} {{ $recipient->last_name }}</option>
                    @endif
                  @endforeach
                </select>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg font-semibold hover:bg-blue-600 transition-all mt-2">Transfer</button>
              </form>
            </div>
          </div>

      <!-- Delete Button -->
      <form action="{{ route('bank.destroy', $user->id) }}" method="POST" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full bg-gray-600 text-white py-2 rounded-lg font-semibold hover:bg-gray-700 transition-all" onclick="return confirm('Are you sure you want to delete this user?');">
          ❌ Delete
        </button>
      </form>

        </div>
      @endforeach
    </div>
  </div>

</body>
</html>
