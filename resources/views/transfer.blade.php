<form action="{{ route('bank.transfer', $bankUser->id) }}" method="post">
    @csrf
    <label for="recipient_id" class="block text-gray-700">Recipient ID:</label>
    <input type="number" id="recipient_id" name="recipient_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>

    <label for="amount" class="block text-gray-700 mt-4">Amount to Transfer:</label>
    <input type="number" id="amount" name="amount" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
    
    <button type="submit" class="mt-4 w-full py-3 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition">Transfer</button>
</form>
