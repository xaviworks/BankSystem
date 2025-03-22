<?php

namespace App\Http\Controllers;

use App\Models\BankUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankUserController extends Controller
{
    // Display a list of active bank accounts (excluding soft-deleted ones)
    public function index()
    {
        $bankUsers = BankUser::where('is_deleted', false)->get();
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
        $bankUser = BankUser::where('is_deleted', false)->findOrFail($id);

        $this->validateBankUser($request);

        $bankUser->update($request->all());

        return redirect()->route('bank.index')->with('success', 'Bank user updated successfully!');
    }

    // Soft delete an existing bank user account
    public function destroy($id)
    {
        $bankUser = BankUser::where('is_deleted', false)->findOrFail($id);
        $bankUser->update(['is_deleted' => true]); // Soft delete instead of removing

        return redirect()->route('bank.index')->with('success', 'Bank user soft-deleted successfully!');
    }

    // Restore a soft-deleted bank user
    public function restore($id)
    {
        $bankUser = BankUser::where('is_deleted', true)->findOrFail($id);
        $bankUser->update(['is_deleted' => false]); // Restore user

        return redirect()->route('bank.index')->with('success', 'Bank user restored successfully!');
    }

    // Check balance of a bank user account
    public function checkBalance($id)
    {
        $bankUser = BankUser::where('is_deleted', false)->findOrFail($id);
        return view('bank.check_balance', compact('bankUser'));
    }

    // Withdraw funds from a bank user account
    public function withdraw(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $bankUser = BankUser::where('is_deleted', false)->findOrFail($id);

        if ($bankUser->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance!');
        }

        $bankUser->balance -= $request->amount;
        $bankUser->save();

        return back()->with('success', 'Withdrawal successful!');
    }

    // Deposit funds into a bank user account
    public function deposit(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $bankUser = BankUser::where('is_deleted', false)->findOrFail($id);

        $bankUser->balance += $request->amount;
        $bankUser->save();

        return back()->with('success', 'Deposit successful!');
    }

    // Transfer funds to another bank user
    public function transfer(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'recipient_id' => 'required|exists:bank_users,id',
        ]);

        DB::beginTransaction();

        try {
            $sender = BankUser::where('is_deleted', false)->findOrFail($id);
            $recipient = BankUser::where('is_deleted', false)->findOrFail($request->recipient_id);

            if ($sender->balance < $request->amount) {
                return back()->with('error', 'Insufficient balance for transfer!');
            }

            $sender->balance -= $request->amount;
            $recipient->balance += $request->amount;

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
            'balance' => 'required|numeric',
        ]);
    }
}
