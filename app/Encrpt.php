<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encrpt extends Model
{
    protected $fillable = [
        'p', 'q', 'e', 'd', 'message',
    ];

}
