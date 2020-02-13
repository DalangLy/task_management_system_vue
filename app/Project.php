<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'client_account_id', 'user_id', 'project_code', 'project_name', 'disabled'
    ];
}
