<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController
{
    public function index()
    {
        $user = User::where('role', 'admin')->get();
        return $user;
 
    }
}
