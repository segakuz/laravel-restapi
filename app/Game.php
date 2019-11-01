<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $fillable = ['title', 'description', 'complexity', 'is_active'];
    protected $hidden = ['deleted_at'];
}
