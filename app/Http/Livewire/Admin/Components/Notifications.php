<?php

namespace App\Http\Livewire\Admin\Components;

use App\Helper\Helper;
use App\Http\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Notifications extends Component
{
    public $notificationCount;
    public $unreadNotifications;

    public function getListeners()
    {
        $adminId = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : Auth::id();
        $prefix = Helper::getBroadcasterPrefix();
        return [
            "echo:" . $prefix . "private-App.Models.Admin.{$adminId},.Illuminate\Notifications\Events\BroadcastNotificationCreated" => 'notifyNewNotification',
            "refreshComponent" => 'mount',
        ];
    }

    public function mount()
    {
        if (Auth::check()) {
            $this->notificationCount = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->unreadNotifications()->count() :Auth::user()->unreadNotifications()->count();
            $this->unreadNotifications = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->unreadNotifications : Auth::user()->unreadNotifications;
        } else {
            $this->notificationCount = 0;
            $this->unreadNotifications = [];
        }
    }

    public function render()
    {
        return view('livewire.admin.components.notifications');
    }

    public function markAll()
    {

        foreach (Auth::guard('admin')->check() ? Auth::guard('admin')->user()->unreadNotifications : Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        $this->notificationCount = 0;
        $this->unreadNotifications = [];

        flash(__('global.operation completed successfully'), 'success')->livewire($this);
    }

    public function notifyNewNotification($notification)
    {
        if (isset($notification['action']) && $notification['action'] == 'error') {
            flash($notification['message'],'error')->livewire($this);
        } else {
            flash($notification['message'],'success')->livewire($this);
        }
        $this->mount();
    }
}
