<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SearchNav extends Component
{

    use LivewireAlert;

    public $search = '';
    public $showModal = false;
    public $searchResults;
    public $userId;
    public $isSearching = false;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->userId = auth()->id();
        $this->searchResults = collect([]);
    }

    public function toggleModal()
    {
        $this->reset(['search', 'searchResults', 'isSearching']);
        $this->showModal = !$this->showModal;
    }

    public function updatedSearch()
    {
        $this->validate([
            'search' => 'required|min:3'
        ]);

        $this->isSearching = true;

        try {
            $query = Transaction::query()
                ->where('users_id', $this->userId)
                ->whereIn('transaction_status', ['SUCCESS', 'PENDING']);

            $this->searchResults = $query->where(function ($query) {
                $query->where('order_id', 'like', '%' . $this->search . '%')
                    ->orWhere('payment_method', 'like', '%' . $this->search . '%')
                    ->orWhereHas('travel_package', function ($q) {
                        $q->where('title', 'like', '%' . $this->search . '%');
                    });
            })
                ->with(['travel_package'])
                ->get();

            if ($this->searchResults->isEmpty()) {
                $this->alert('info', 'No data found with search term: ' . $this->search);
            }
        } catch (\Exception $e) {
            $this->alert('error', 'Error searching: ' . $e->getMessage());
            $this->searchResults = collect([]);
        }

        $this->isSearching = false;
    }



    public function render()
    {
        return view('livewire.search-nav');
    }
}
