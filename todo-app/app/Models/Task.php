<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'completed_at'];
    protected $casts = ['completed_at' => 'datetime',];
}
