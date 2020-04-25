<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingCommand extends Model
{
    protected $table = 'commands';
    protected $primary = 'id';

    protected $fillable = [
        'id', 'command', 'description', 'value', 'category_id', 'status'
    ];

    public function command() {
        return $this->belongsTo(Command::class, 'command_id');
    }
}
