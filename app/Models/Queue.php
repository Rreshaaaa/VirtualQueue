<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','status', 'queue_number'];

    public function Student()
    {
        return $this->belongsTo(User::class);
    }


}
