<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $primaryKey = 'gender_id';

    protected $fillable = [
        'gender',
    ];
}
