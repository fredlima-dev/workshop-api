<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Workshop;
use Illuminate\Http\Request;
use function Couchbase\defaultDecoder;

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
    
  
    public function confirmWorkshop(Request $request)
    {
        $workshop_id = $request['id_workshop'];
        foreach($request['id_user'] as $student_id){
        $subscription = Subscription::where('workshop_id', $workshop_id)->where('student_id',$student_id)->first();
        $subscription->confirmed = 1 ;
        $subscription->save();
        }
    }
}

