<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    public function queue(){
        return $this->hasOne(Queue::class);
    }

    protected $fillable = [
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'contact_number',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            $student->student_number = self::generateStudentNumber();
        });
    }

    protected static function generateStudentNumber()
    {
        $prefix = 'STN';
        $year = now()->format('Y'); // e.g. 2025
        $random = rand(10000, 99999); // Random 5-digit number
        return $prefix . $year . $random;
    }
}
