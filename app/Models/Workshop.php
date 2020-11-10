<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'lead', 'description', 'instructor', 'datetime', 'duration'];

    public static function validate($data){
        $rules = [
            'title' => 'required',
            'lead' => 'required|max:255',
            'description' => 'required',
            'instructor' => 'required',
            'datetime' => 'required|datetime'
        ];

        return Validator::make($data, $rules);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
