<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primary = 'id';

    protected $fillable = [
        'id', 'name', 'description', 'category_id'
    ];

    public function commands() {
        return $this->hasMany(Command::class, 'category_id');
    }
}
