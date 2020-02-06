<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    protected $primaryKey = 'task_type_id';

    protected $fillable = [
        'user_id', 'task_type',
    ];
}
