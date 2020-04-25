<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;
use App\Category;
use SwooleTW\Http\Websocket\Facades\Websocket;

class CommandController extends Controller
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
        $commands = Command::all();
        return view('command.index')->with('commands', $commands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('command.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $command = new Command();

        $command->name = $request->name;
        $command->description = $request->description;
        $command->value = $request->value;
        $command->category_id = $request->category;
        $command->status = $request->status;

        $command->save();

        $commands = Command::all();
        return view('command.index')->with('commands', $commands);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function show(Command $command)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function edit(Command $command)
    {
        $categories = Category::all();
        return view('command.edit', [
            'categories' => $categories,
            'command'=> $command
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Command $command)
    {
        $command->name = $request->name;
        $command->description = $request->description;
        $command->value = $request->value;
        $command->category_id = $request->category;
        $command->status = $request->status;

        $command->save();

        $commands = Command::all();
        return view('command.index')->with('commands', $commands);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function destroy(Command $command)
    {
        $command->delete();

        $commands = Command::all();
        return view('command.index')->with('commands', $commands);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function execute(Request $request, Command $command)
    {
        $message = str_replace("code", $request->code, $request->commandVal);
        Websocket::broadcast()->emit('message', $message);

        $commands = Command::all();
        return view('command.index')->with('commands', $commands);
    }
}
