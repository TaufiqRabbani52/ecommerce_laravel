<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Distributor; // <-- Tambahkan model Distributor

class ListController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        $users = User::all();
        $distributors = Distributor::all(); // <-- Ambil data distributor

        return view('welcome', compact('admins', 'users', 'distributors')); 
    }
}
