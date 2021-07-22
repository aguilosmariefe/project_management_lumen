<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        // $this->middleware('auth');
    }

    public function index()
    {
        return $this->userService->all();
    }

    public function summary()
    {
        return $this->userService->summary();
    }

    public function getByRole($role)
    {
        return $this->userService->getAllByRole($role);
    }

    public function projects($id)
    {
        return $this->userService->projects($id);
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        return $this->userService->create($validated);
    }

    public function update(Request $request, User $user)
    {
        $validated = $this->validateRequest($request);

        return $this->userService->update($validated, $user);
    }

    private function validateRequest(Request $request)
    {
        return $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email',
            'type' => 'required'
        ]);
    }
}
