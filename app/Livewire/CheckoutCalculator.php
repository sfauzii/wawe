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

    public function mount($transactionId)
    {
        $this->transaction = Transaction::findOrFail($transactionId);
        $this->calculateTotals();
    }

    public function updatedPaymentMethod()
    {
        $this->calculateTotals();
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
        $this->grandTotal = $this->subTotal + $this->ppn;

        // Update transaction
        $this->transaction->update([
            'payment_method' => $this->paymentMethod,
            'sub_total' => $this->subTotal,
            'ppn' => $this->ppn,
            'grand_total' => $this->grandTotal,
        ]);
    }
    public function render()
    {
        return view('livewire.checkout-calculator');
    }
}
