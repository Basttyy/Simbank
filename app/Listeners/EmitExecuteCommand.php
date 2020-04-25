<?php

namespace App\Listeners;

use App\Events\ExecuteCommand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmitExecuteCommand
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ExecuteCommand  $event
     * @return void
     */
    public function handle(ExecuteCommand $event)
    {
        //
    }
}
