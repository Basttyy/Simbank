<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    protected $table = 'commands';
    protected $primary = 'id';

    protected $fillable = [
        'id', 'name', 'description', 'value', 'category_id', 'status'
    ];

    public function commandHistories() {
        return $this->hasMany(CommandHistory::class, 'command_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
