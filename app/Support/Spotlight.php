<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class Spotlight
{

    public function search(Request $request)
    {
        // Example of security concern
        // Guests can not search
        if(! Auth::user()) {
            return [];
        }

        return collect()
            ->merge($this->loans($request->search))
            ->merge($this->users($request->search));
    }

        // Database search
    public function users(string $search = '')
    {
         return User::query()
            ->where('first_name', 'ilike', "%$search%")
            ->take(5)
            ->get()
            ->map(function (User $user) {
                return [
                    // 'avatar' => $user->avatar ?? '/empty-user.jpg',
                    'name' => $user->first_name,
                    'description' => $user->email,
                    'link' => "/users/{$user->id}/edit"
                ];
            });
    }

    public function loans(string $search = '')
    {
        return Loan::query()->with('client')
                ->where('client.first_name', 'ilike', "%$search%")
                ->take(5)
                ->get()
                ->map(function (Loan $loan) {
                    return [
                        // 'avatar' => $loan->profile_picture,
                        'name' => $loan->name,
                        'description' => $loan->email,
                        'link' => "/users/{$loan->id}"
                    ];
                });
    }
}
