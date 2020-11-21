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

    public function show_id($id){
        $get = DB::table('subscriptions as sub')
        ->select ('s.name as name', 's.email as email', 'w.name as workshop')
        ->join('students as s', 'sub.student_id', '=', 's.id')
        ->join('workshops as w', 'sub.workshop_id', '=', 'w.id')
        ->where('s.id', $id)
        // ->groupBy('s.id')
        ->get();

        return response()->json($get);
    }
}

// SELECT s.name as Nome, s.email as Email, w.name as Oficinas
// FROM subscriptions as sub
// JOIN workshops as w
// ON w.id = sub.workshop_id
// JOIN students as s
// ON s.id = sub.student_id
// WHERE s.id = 56
// GROUP BY s.id;