<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingModel extends Model
{
    use HasFactory;

    protected $table = 'things';

    protected $fillable = [
        'user_id',
        'one',
        'two',
        'three',
    ];
}
