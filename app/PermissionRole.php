<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $primaryKey = 'permission_role_id';

    protected $fillable = [
        'permission_id', 'role_id',
    ];
}
