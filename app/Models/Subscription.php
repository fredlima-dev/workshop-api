<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['workshop_id', 'student_id', 'confirmed'];

    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
