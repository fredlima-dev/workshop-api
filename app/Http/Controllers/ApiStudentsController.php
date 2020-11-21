<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;

class ApiStudentsController extends Controller
{
    public function show(){

        $get = DB::table('subscriptions as sub')
        ->select('s.name as name', 's.email as email', 'w.name as workshop')
        ->join('students as s', 'sub.student_id', '=', 's.id')
        ->join('workshops as w', 'sub.workshop_id', '=', 'w.id')
        ->groupBy('s.id')
        ->get();

        return response()->json($get);
    }
}