<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $primaryKey = 'leave_request_id';

    protected $fillable = [
        'user_id', 'reason', 'leave_from', 'leave_to', 'supervisor_approved', 'approved',
    ];
}
