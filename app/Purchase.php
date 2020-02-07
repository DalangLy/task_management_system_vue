<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $primaryKey = 'purchase_id';

    protected $fillable = [
        'user_id', 'project_detail_id', 'purchase_type_id', 'paid', 'subject', 'description', 'approved',
    ];
}
