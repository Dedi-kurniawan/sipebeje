<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController as Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function readNotification($id)
    {
        $user = User::findOrFail($this->userId());
        $notification = $user->unreadNotifications->where('id', $id)->first();
        $user->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->route('admin.undangan.paket.konfirmasi', $notification->data['id']);
    }
}
