<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyStructure extends Model
{
    protected $primaryKey = 'company_structure_id';

    protected $fillable = [
        'company_name', 'working_hours', 'starting_hour', 'end_hour', 'relax_hour', 'relax_from', 'relax_to', 'using',
    ];
}
