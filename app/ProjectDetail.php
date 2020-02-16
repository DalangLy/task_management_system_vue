<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $primaryKey = 'project_detail_id';

    protected $fillable = [
        'project_id', 'task_type_id', 'working_code', 'task_name', 'user_id', 'fee', 'start_date', 'end_date', 'finished', 'company_structure_id',
    ];
}
