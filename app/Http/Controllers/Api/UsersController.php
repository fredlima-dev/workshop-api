<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function show(){

        // $users = DB::select('select name, email from users');
        $users = DB::table('users')->select('name as name', 'email as email')->get();

        return ($users);
    }
}