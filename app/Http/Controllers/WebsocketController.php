<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Websocket;
use App\User;
use App\Command;
use App\CommandHistory;
use App\SimSlot;

class WebsocketController extends Controller
{
    /**
     * Handle connect request on websocket
     * 
     */
    public function connect(Websocket $websocket, $data)
    {
        // $websocket->setSender($request->fd);
        // $websocket->loginUsing(auth('api')->user());
        $websocket->emit('message', 'welcome');
    }

    /**
     * Handle disconnect request on websocket
     * 
     */
    public function disconnect(Websocket $websocket, $data)
    {
        $websocket->logout();
    }

    /**
     * Handle message request on websocket
     * 
     */
    public function message(Websocket $websocket, $data)
    {
        $websocket->emit('message', $data);
    }

    /**
     * Handle command request on websocket
     *
     */
    public function handleCommand(Websocket $websocket, $data)
    {
        $command = Command::find($data->id);
        $user = User::find($data->user_id);
        $commandHist = new CommandHistory();

        $command->commandHistories()->save($commandHist);
        $data->message = "command is being processed...";

        $websocket->broadcast()->emit('message', $data);
    }

    /**
     * Handle commandstatus request on websocket
     */
    public function commandStatus(Websocket $websocket, $data)
    {
        $commandHistory = new CommandHistory();
        $simSlot = SimSlot::find($data->simId);
        $commandHist = $commandHistotry->find($data->comdId);
        $commandHist->status = $data->status ? "completed" : "failed";

        $websocket->broadcast()->emit('message', $data);

        $nextCommand = $commandHistory->where('status', 'pending')->orderBy('created_at', 'desc')->first();
        if($nextCommand){
            $obj = new \stdClass;
            $obj->commandValue = $nextCommand->commandValue;
            $obj->commandId = $nextCommand->id;
            $obj->simId = $simSlot->id;
            $websocket->emit('command', $obj);
        } else{
            $simSlot->status = $data->simStatus;
            $simSlot->save();
        }
        $commandHist->save();
    }
}
