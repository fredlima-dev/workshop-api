<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{


    public function getListWorkshop(){

        $worklist = Workshop::all('name','date','duration');
        if(!$worklist){

            return response()->json(
                [
                    'message' => 'Ainda não existem oficinas cadastradas'
                ]
            );
        }else{
            return response()->json($worklist);
        }
    }

    public function subscriberWorkshop(Request $request, Subscription $subscription)
    {
        $subscription = $subscription::where('student_id',$request['student_id'])->where('workshop_id',$request['workshop_id'])->first();
        if(!$subscription){
            $subscription = new Subscription();
            $subscription['workshop_id']=$request['workshop_id'];
            $subscription['student_id']=$request['student_id'];
            $subscription->save();
            return response()->json('usuario cadatraro com sucesso',200);
        }
        return response()->json('usuario ja cadastro',401);
    }

}
