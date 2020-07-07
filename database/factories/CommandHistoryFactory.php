
<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CommandHistory;
use App\Command;
use App\SimSlot;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(CommandHistory::class, function (Faker $faker) {
    $command_id = rand(1,Command::count());
    $command = Command::find($command_id);
    error_log(json_encode($command));
    $status = array('pending', 'executing', 'completed', 'failed');
    return [
        'command_value' => $command->value,
	'command_id' => $command_id,
	'sim_slot_id' => rand(1,SimSlot::count()),
	'user_id' => rand(1,User::count()),
	'status' => $status[rand(0,count($status)-1)]
    ];
});
