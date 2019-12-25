<?php

namespace App\Http\Controllers\Admin;
use App\User;
class HomeController
{
    public function index()
    {
        return view('home');
    }
    public function tableTrack()
    {
        $users = User::all();
        return view('tabelTrack', compact('users'));
    }
}
