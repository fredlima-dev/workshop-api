<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkshopsController extends Controller
{

    public function getListWorkshop(){

        $worklist = DB::table('workshops')->orderBy('date', 'desc')->get();
        if($worklist == false){

            return response()->json(
                [
                    'message' => 'Ainda não existem oficinas cadastradas'
                ]
            );
        }else{
            return response()->json($worklist);
        }

    }

    public function createWorkshop(Request $request){
        $data = $request->only('name', 'panelist', 'date', 'duration', 'subscribers', 'detailsLink');

        $validator = Workshop::validate($data);

        if($validator->fails()){
            return response()->json([
                'error' => 'Dados inválidos',
                'teste' => $data,
                'data' => $validator->fails()
            ], 400);
        }

        $workshop = Workshop::create($data);
        return response()->json([
            "message" => "Gravado com sucesso",
            "data"=> $workshop            
        ]);
    }


    public function deleteWorkshop(Request $request){
        $id = $request->route('id');

        DB::table('workshops')->where('id', '=', $id)->delete();

        return response()->json(
            ["message" => "Registro deletado com sucesso"]
        );
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

