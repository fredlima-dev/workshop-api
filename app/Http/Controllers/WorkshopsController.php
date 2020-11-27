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

    public function update($id, $name, $panelist, $date, $duration)
    {
        $update = Workshop::where('id', $id)
            ->update(['name' => $name, 
            'panelist' => $panelist, 
            'date' => $date, 
            'duration' => $duration]);
            
        return $update;
    }// As migrations nao contem a conula referente a "descrição"
    

}

