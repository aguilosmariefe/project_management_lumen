<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function all()
    {
        return User::all();
    }

    public function summary(): array
    {
        return [
            'all' => User::all()
                ->filter(fn ($user) => $user->type !== User::ADMIN)
                ->count(),
            'pm' => User::where('type', User::PM)->count(),
            'dev' => User::where('type', User::DEV)->count()
        ];
    }

    public function getAllByRole(string $role)
    {
        return User::where('type', $role)->get();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function projects($id)
    {
        return $this->findById($id)->projects()->latest()->get();
    }

    public function create(array $data)
    {
        $user = array_merge($data, [
            'password' => Hash::make('password')
        ]);

        return User::create($user);
    }

    public function update(array $data, User $user)
    {

        $user->update($data);

        return $user;
    }
}
