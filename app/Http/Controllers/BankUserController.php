<?php

namespace App\Http\Controllers;

use App\Models\BankUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankUserController extends Controller
{
    // Display a list of bank accounts along with functionality to check balance, withdraw, deposit, and transfer
    public function index()
    {
        $bankUsers = BankUser::all(); // Fetch all bank users
        return view('bank.index', compact('bankUsers'));
    }

    // Show the form to create a new bank account
    public function create()
    {
        return view('bank.create');
    }

    // Store a new bank user account
    public function store(Request $request)
    {
        $this->validateBankUser($request);

        BankUser::create($request->only(['first_name', 'middle_name', 'last_name', 'occupation', 'balance']));

        return redirect()->route('bank.index')->with('success', 'Bank user created successfully!');
    }

    // Update an existing bank user account
    public function update(Request $request, $id)
    {
        $bankUser = BankUser::findOrFail($id);

        $this->validateBankUser($request);

        $bankUser->update($request->all());

        return redirect()->route('bank.index')->with('success', 'Bank user updated successfully!');
    }

    // Delete an existing bank user account
    public function destroy($id)
    {
        $bankUser = BankUser::findOrFail($id);
        $bankUser->delete();

        return redirect()->route('bank.index')->with('success', 'Bank user deleted successfully!');
    }

    // Check balance of a bank user account
    public function checkBalance($id)
    {
        $bankUser = BankUser::findOrFail($id);
        return view('bank.check_balance', compact('bankUser'));
    }

    // Withdraw funds from a bank user account
    public function withdraw(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',  // Ensure amount is positive
        ]);

        $bankUser = BankUser::findOrFail($id);

        // Check if the bank user has sufficient balance
        if ($bankUser->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance!');
        }

        // Deduct the withdrawal amount
        $bankUser->balance -= $request->amount;
        $bankUser->save();

        return back()->with('success', 'Withdrawal successful!');
    }

    // Deposit funds into a bank user account
    public function deposit(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',  // Ensure amount is positive
        ]);

        $bankUser = BankUser::findOrFail($id);

        // Add the deposit amount
        $bankUser->balance += $request->amount;
        $bankUser->save();

        return back()->with('success', 'Deposit successful!');
    }

    // Transfer funds to another bank user
    public function transfer(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',  // Ensure amount is positive
            'recipient_id' => 'required|exists:bank_users,id',  // Ensure recipient exists
        ]);

        // Using a transaction for atomic operation
        DB::beginTransaction();

        try {
            $sender = BankUser::findOrFail($id);
            $recipient = BankUser::findOrFail($request->recipient_id);

            // Check if the sender has sufficient balance for the transfer
            if ($sender->balance < $request->amount) {
                return back()->with('error', 'Insufficient balance for transfer!');
            }

            // Perform the transfer
            $sender->balance -= $request->amount;
            $recipient->balance += $request->amount;

            // Save both sender and recipient balances
            $sender->save();
            $recipient->save();

            DB::commit();

            return back()->with('success', 'Transfer successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred during the transfer. Please try again!');
        }
    }

    /**
     * A helper method to validate bank user input.
     */
    protected function validateBankUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'balance' => 'required|numeric',  // Balance should be numeric and cannot be negative
        ]);
    }
}
