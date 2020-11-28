<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkshopsController extends Controller
{
    
    
    public function getListWorkshopId(Request $request){
        $id = $request->route('id');

        $workshop = DB::table('workshops')
                                            ->where('id', $id)
                                            ->first();

        return response()->json($workshop);
    }

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
    
}
