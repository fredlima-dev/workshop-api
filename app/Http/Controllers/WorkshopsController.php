<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
    
    
    public function getListWorkshop(){

        $worklist = Workshop::all();
        if($worklist->empty()){

            return response()->json(
                [
                    'message' => 'Ainda não existem oficinas cadastradas'
                ]         
            );
        }else{
            return response()->json($worklist);
        }
    }
    
}
