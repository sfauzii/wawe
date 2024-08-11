<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TravelPackage;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TransactionForm extends Component
{

    use LivewireAlert;


    public $travelPackages;
    public $selectedPackageId;
    public $newUsername = '';
    public $usernames = [];
    public $totalAmount = 0;
    public $remainingQuota = 0;

    public function mount()
    {
        $this->travelPackages = TravelPackage::all();
    }

    public function addUser()
    {
        if (!empty($this->newUsername)) {
            $this->usernames[] = $this->newUsername;
            $this->newUsername = '';
            $this->calculateTotal();
        }
    }

    public function removeUser($index)
    {
        unset($this->usernames[$index]);
        $this->usernames = array_values($this->usernames);
        $this->calculateTotal();
    }

    public function updatedSelectedPackageId()
    {
        $this->calculateTotal();
    }

    private function calculateTotal()
    {
        if ($this->selectedPackageId) {
            $package = TravelPackage::find($this->selectedPackageId);
            $userCount = count($this->usernames);
            $this->totalAmount = $package->price * $userCount;
            $this->remainingQuota = $package->kuota - $userCount;
        } else {
            $this->totalAmount = 0;
            $this->remainingQuota = 0;
        }
    }

    public function createTransaction() {

        if(!$this->selectedPackageId) {
            $this->alert('error', 'Validation Error', [
                'text' =>  'Please select a travel package'
            ]);
            return;
        }

        $this->validate([
            'selectedPackageId' => 'required',
            'usernames.*' => 'required|string|max:255',
        ]);

        if (count($this->usernames) === 0) {
            $this->alert('error', 'Validation Error', [
                'text' => 'At least one usernames must be entered.'
            ]);

            return;
        }

        $package = TravelPackage::findOrFail($this->selectedPackageId);
        $userCount = count($this->usernames);

        if($package->kuota < $userCount) {
            $this->alert('error', 'Quota Error', [
                'text' => 'No more quota available for this package.'
            ]);

            return;
        }

        // Deduct the quota by the number of users (excluding the admin/super-admin)
        $package->kuota -= $userCount;
        $package->save();

        // Create the transaction with the logged-in user as the creator
        $transaction = Transaction::create([
            'travel_packages_id' => $this->selectedPackageId,
            'transaction_total' => $this->totalAmount,
            'transaction_status' => 'PENDING',
            'users_id' => Auth::id(),
        ]);

        // Process each username and add to TransactionDetail
        foreach($this->usernames as $username) {
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'username' => $username,
            ]);
        }

        $this->alert('success', 'Success', [
            'text' => 'Transaction created successfully!'
        ]);

        return redirect()->route('transaction.payment', ['transaction' => $transaction]);

    }
    public function render()
    {
        return view('livewire.transaction-form');
    }
}
