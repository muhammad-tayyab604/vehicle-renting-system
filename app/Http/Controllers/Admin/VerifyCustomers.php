<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserUnVerifiedNotification;
use App\Notifications\UserVerifiedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class VerifyCustomers extends Controller
{
    public function verifyCustomersIndex()
    {
        $usersQuery = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->orderBy('created_at', 'desc'); // Order by 'created_at' in descending order

        $perPage = 10; // Number of results per page
        $users = $usersQuery->paginate($perPage);

        return view('AdminPanel.verifyCustomers', compact('users'));
    }

    public function verifyCustomers(User $user)
    {
        $user->update(['verifiedUser' => true]);

        Notification::send($user, new UserVerifiedNotification);

        return redirect()->back()->with('success', 'User verified successfully');
    }
    public function unVerifyCustomers(User $user)
    {
        $user->update(['verifiedUser' => false]);

        Notification::send($user, new UserUnVerifiedNotification);

        return redirect()->back()->with('success', 'User Unverified successfully');
    }
}