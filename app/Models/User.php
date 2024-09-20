<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Notifications\Notifiable;
use App\Notifications\OtpNotification;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Otp;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_SUPERADMIN = 'super admin';
    const ROLE_DOCTOR = 'doctor';

    const DEFAULT_PASSWORD = 'admin123';

    public function sendOtpNotification()
    {
        $otp = rand(100000, 999999); // Generate a 6-digit OTP

        Otp::create([
            'user_id' => $this->id,
            'otp' => $otp,
            'is_used' => false,
        ]);

        $this->notify(new OtpNotification($otp));
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'super admin']);
    }



}