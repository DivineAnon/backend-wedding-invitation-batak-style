<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = ['bank_name', 'account_number', 'account_name', 'qr_image', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
