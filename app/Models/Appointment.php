<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'date',
        'department',
        'doctor',
        'description',
        'status'
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_PENDING = 'pending';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}