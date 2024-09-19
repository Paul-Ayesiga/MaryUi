<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NavBar extends Component
{
    public bool $notifications = false;
    public bool $messages = false;
    public $notificationList = [];
    public $search = '';


    public function spotlight(){
        $this->dispatch('toggle-spotlight');
    }

    public function mount()
    {
        $this->getNotifications();
    }

    public function getNotifications()
    {
        $this->notificationList = Auth::user()->unreadNotifications;
         // Fetch unread notifications for the authenticated user and apply search filter
        // $this->notificationList->count();
    }

     public function updatedSearch()
    {
        // Refresh the notification list when the search term is updated
        $this->getNotifications();
    }

    public function deleteNotification($notificationId)
    {
        // // Find and mark the notification as read
        // $notification = DatabaseNotification::find($notificationId);
        // if ($notification) {
        //     $notification->markAsRead();
        //     $this->getNotifications(); // Refresh the notification list
        // }
        $notification = Auth::user()->notifications->find($notificationId);
        if ($notification) {
            $notification->delete();
            $this->getNotifications(); // Refresh the notification list
        }
    }

    public function clearAll()
    {
        DatabaseNotification::where('notifiable_type', 'App\Models\User')
        ->where('notifiable_id', Auth::id())
        ->whereNull('read_at')
        ->delete();

        $this->getNotifications();

    }

    public function render()
    {
        return view('livewire.nav-bar', [
            'notifications' => $this->notificationList,
        ]);
    }
}
