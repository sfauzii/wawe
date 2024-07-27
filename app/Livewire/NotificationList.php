<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class NotificationList extends Component


{

    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap'; // Use Bootstrap pagination theme
    

    public function render()
    {

        $notifications = Auth::user()->notifications()->latest()->paginate(10);
        
        return view('livewire.notification-list', [
            'notifications' => $notifications
        ]);
    }

    public function markAsRead($id)
    {
        // $notification = Auth::user()->notifications()->find($id);

        // if ($notification) {
        //     $notification->markAsRead();
        //     session()->flash('message', 'Notification marked as read.');
        // }

        $user = Auth::user();

        // Find the notification by ID
        $notification = $user->notifications()->find($id);

        if ($notification) {
            // Mark the notification as read
            $notification->markAsRead();
            $this->alert('success', 'Notification marked as read.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', 'Notification not found.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        
        $this->alert('success', 'All notifications marked as read.', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
}
