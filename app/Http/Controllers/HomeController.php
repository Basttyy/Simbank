<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SimSlot;
use App\CommandHistory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $commandHistory = CommandHistory::all();
        return view('home')->with('commands', $commandHistory);
    }
}
