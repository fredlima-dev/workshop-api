<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'due', 'status', 'priority', 'duration'];

    public static function validate($data){
        $rules = [
          'title' => 'required',
          'status' => 'required|in:pending,doing,done',
          'priority' => 'required|in:low,medium,high'
        ];

        return Validator::make($data, $rules);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
