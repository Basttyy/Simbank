<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommandHistory extends Model
{
    protected $table = 'command_histories';
    protected $primary = 'id';

    protected $fillable = [
        'id', 'command_id', 'sim_slot_id', 'user_id', 'status'
    ];

    public function command() {
        return $this->belongsTo(Command::class, 'command_id');
    }

    public function simSlot() {
        return $this->belongsTo(SimSlot::class, 'sim_slot_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
