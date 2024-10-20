<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class CheckoutCalculator extends Component



{

    public $transaction;
    public $paymentMethod = 'full_payment';
    public $subTotal = 0;
    public $ppn = 0;
    public $grandTotal = 0;
    public $uniqueCode = 0;

    public function mount($transactionId)
    {
        $this->transaction = Transaction::findOrFail($transactionId);
        $this->generateUniqueCode();
        $this->calculateTotals();
    }

    public function updatedPaymentMethod()
    {
        $this->generateUniqueCode();
        $this->calculateTotals();
    }

    public function generateUniqueCode()
    {
        $this->uniqueCode = rand(100, 999); // Generate 3-digit random number
    }

    public function calculateTotals()
    {
        $userCount = TransactionDetail::where('transactions_id', $this->transaction->id)->count();
        $price = $this->transaction->travel_package->price;

        $this->subTotal = $userCount * $price;

        if ($this->paymentMethod === 'down_payment') {
            $this->subTotal *= 0.3; // 30% untuk down payment
        }

        $this->ppn = $this->subTotal * 0.11; // 11% PPN
        $this->grandTotal = $this->subTotal + $this->ppn - $this->uniqueCode; // Subtract unique code from grand total

        // Update transaction
        $this->transaction->update([
            'payment_method' => $this->paymentMethod,
            'sub_total' => $this->subTotal,
            'ppn' => $this->ppn,
            'unique_code' => $this->uniqueCode, // Save unique code
            'grand_total' => $this->grandTotal,
        ]);
    }
    public function render()
    {
        return view('livewire.checkout-calculator');
    }
}
