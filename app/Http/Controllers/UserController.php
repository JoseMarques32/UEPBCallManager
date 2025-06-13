<?php

namespace App\Http\Controllers;
use App\Models\User;
class UserController
{
    public function index()
    {
        $users = User::create(['name' => 'John Doe', 'email' => 'john@email', 'password' => 'password123']);
        return $users;
    }
}
