<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'panelist', 'date', 'duration', 'subscribers', 'detailsLink'];

    public static function validate($data){
        $rules = [
            'name' => 'required',
            'panelist' => 'required',
            'date' => 'required',
            'duration' => 'required',
            'subscribers' => 'required',
            'detailsLink' => 'required'
        ];

        return Validator::make($data, $rules);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
