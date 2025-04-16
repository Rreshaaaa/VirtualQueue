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
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'student_number',
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
        // Example format: STU202504161234
        $prefix = 'STU';
        $date = now()->format('Ymd'); // 20250416
        $random = rand(1000, 9999); // Random 4-digit number
        return $prefix . $date . $random;
    }
}
