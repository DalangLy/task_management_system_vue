<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseType extends Model
{
    protected $primaryKey = 'purchase_type_id';

    protected $fillable = [
        'purchase_type_name',
    ];
}
