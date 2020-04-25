<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimSlot extends Model
{
    protected $table = 'sim_slots';
    protected $primary = 'id';

    protected $fillable = [
        'id', 'phone_num', 'balance', 'status', 'provider'
    ];

    public function CommandHistory() {
        return $this->hasMany(CommandHistory::class, 'sim_slot_id');
    }
}
