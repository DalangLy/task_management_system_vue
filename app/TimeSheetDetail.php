<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheetDetail extends Model
{
    protected $primaryKey = 'time_sheet_detail_id';

    protected $fillable = [
        'time_sheet_id', 'work_date', 'start_time', 'end_time', 'current_salary', 'company_structure_id',
    ];
}
