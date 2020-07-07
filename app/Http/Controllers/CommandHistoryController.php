<?php

namespace App\Http\Controllers;

use App\CommandHistory;
use Illuminate\Http\Request;

class CommandHistoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandHistories = CommandHistory::all();
        return view('command_history.index')->with('commands', $commandHistories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommandHistory  $commandHistory
     * @return \Illuminate\Http\Response
     */
    public function show(CommandHistory $commandHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CommandHistory  $commandHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(CommandHistory $commandHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommandHistory  $commandHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommandHistory $commandHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommandHistory  $commandHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommandHistory $commandHistory)
    {
        $commandHistory->delete();
	$commandHistories = CommandHistory::all();
	return view('home')->with('commands', $commandHistories);
    }
}
