<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name', 'slug', 'phone', 'email',
        'rsvp_status', 'attendance_count',
        'message', 'language', 'category',
        'has_opened', 'opened_at',
        'attended_church', 'church_scanned_at',
        'attended_reception', 'reception_scanned_at',
    ];

    protected $casts = [
        'has_opened'         => 'boolean',
        'opened_at'          => 'datetime',
        'attended_church'    => 'boolean',
        'church_scanned_at'  => 'datetime',
        'attended_reception' => 'boolean',
        'reception_scanned_at'=> 'datetime',
    ];

    public function photoBooths()
    {
        return $this->hasMany(PhotoBooth::class);
    }
}
