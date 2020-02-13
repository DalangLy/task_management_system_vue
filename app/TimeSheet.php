<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    protected $primaryKey = 'time_sheet_id';

    protected $fillable = [
        'user_id', 'salary', 'project_detail_id',
    ];
}
