<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckoutCalculator extends Component

{

    use LivewireAlert;

    public $transaction;
    public $paymentMethod = 'full_payment';
    public $subTotal = 0;
    public $ppn = 0;
    public $grandTotal = 0;
    public $uniqueCode = 0;
    public $terms; // Add terms property

    public function mount($transactionId)
    {
        $this->transaction = Transaction::findOrFail($transactionId);

        // Check if the unique code is already set, if not, generate it
        if (!$this->transaction->unique_code) {
            $this->generateUniqueCode();
        } else {
            // Use the existing unique code from the transaction if already set
            $this->uniqueCode = $this->transaction->unique_code;
        }

        $this->calculateTotals();
    }

    public function updatedPaymentMethod()
    {
        // $this->generateUniqueCode();
        $this->calculateTotals();
    }

    public function generateUniqueCode()
    {
        // Generate a 3-digit random number
        $this->uniqueCode = rand(100, 999);

        // Update the transaction with the generated unique code (only if it's a new transaction)
        $this->transaction->update([
            'unique_code' => $this->uniqueCode
        ]);
    }

    public function calculateTotals()
    {
        $userCount = TransactionDetail::where('transactions_id', $this->transaction->id)->count();
        $price = $this->transaction->travel_package->price;

        // If there are no users, set the grand total to zero
        if ($userCount == 0) {
            $this->subTotal = 0;
            $this->ppn = 0;
            $this->grandTotal = 0;
        } else {
            // Otherwise, calculate the totals based on the number of users
            $this->subTotal = $userCount * $price;

            if ($this->paymentMethod === 'down_payment') {
                $this->subTotal *= 0.25; // 25% for down payment
            }

            // Calculate PPN (11% VAT)
            // $this->ppn = $this->subTotal * 0.11;
            $this->ppn = 10000;

            // Calculate grand total, subtracting the unique code
            $this->grandTotal = $this->subTotal + $this->ppn - $this->uniqueCode;
        }

        // Update the transaction with the new totals
        $this->transaction->update([
            'payment_method' => $this->paymentMethod,
            'sub_total' => $this->subTotal,
            'ppn' => $this->ppn,
            'unique_code' => $this->uniqueCode, // Save the unique code
            'grand_total' => $this->grandTotal,
        ]);
    }

    public function processPayment()
    {
        // Validate that terms have been agreed to
        if ($this->terms !== 'agree') {
            $this->alert('error', 'Oppss', [
                'text' => 'Mohon centang persetujuan Terms and Conditions sebelum melakukan process payment.',
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'position' => 'center',
                'timer' => null
            ]);
            return;
        }

        // Redirect to the checkout success route if validation passes
        return redirect()->route('checkout-success', $this->transaction->id);
    }

    public function render()
    {
        return view('livewire.checkout-calculator');
    }
}
