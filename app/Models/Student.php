<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'cpf', 'birthdate', 'gender'];

    public static function validate($data){
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'cpf' => 'required|unique',
            'birthdate' => 'required|date',
            'gender' => 'required|in:male,female,other'
        ];

        return Validator::make($data, $rules);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
