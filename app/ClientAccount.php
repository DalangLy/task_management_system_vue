<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model
{
    protected $primaryKey = 'client_account_id';

    protected $fillable = [
        'user_id', 'client_id', 'client_account',
    ];
}
