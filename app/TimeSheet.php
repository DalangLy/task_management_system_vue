<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    protected $primaryKey = 'time_sheet_id';

    protected $fillable = [
        'user_id', 'current_work_salary', 'project_detail_id', 'working_date', 'start_time', 'end_time',
    ];
}
