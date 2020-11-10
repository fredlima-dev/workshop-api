<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index(Request $request){
        $tasks = Task::where('user_id', $request->get('user_id'))->orderBy('id', 'desc')->get();

        return response()->json($tasks);
    }

    public function create(Request $request){
        $data = $request->only('user_id', 'title', 'description', 'due', 'status', 'priority', 'duration');

        $validator = Task::validate($data);

        if($validator->fails()){
            return response()->json([
                'error' => 'Dados inválidos',
                'data' => $validator->fails()
            ], 400);
        }

        $task = Task::create($data);
        return response()->json($task);
    }

    public function details(Request $request, $id){
        $task = Task::where('id', $id)
                    ->where('user_id', $request->get('user_id'))
                    ->with('user')
                    ->first();

        if(!$task){
            return response()->json([
                'error' => 'Dados não encontrados.'
            ], 404);
        }

        return response()->json($task);
    }

    public function update(Request $request, $id){
        $data = $request->only('user_id', 'title', 'description', 'due', 'status', 'priority', 'duration');

        $task = Task::where('id', $id)
                    ->where('user_id', $request->get('user_id'))
                    ->first();

        if(!$task){
            return response()->json([
                'error' => 'Dados não encontrados.'
            ], 404);
        }

        $validator = Task::validate($data);

        if($validator->fails()){
            return response()->json([
                'error' => 'Dados inválidos',
                'data' => $validator->fails()
            ], 400);
        }

        $task->fill($data);
        $task->save();

        return response()->json($task);

    }

    public function delete(Request $request, $id){
        Task::where('id', $id)
            ->where('user', $request->get('user_id'))
            ->delete();
    }
}
