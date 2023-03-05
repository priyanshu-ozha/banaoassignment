<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function add(Request $request){
        try{

            $obj= new Task();
            $obj->user_id=$request->user_id;
            $obj->task=$request->task;
            $result= $obj->save();
            if($result){
                return response()->json([
                    "status" => 1 ,
                    "message" => 'successfully created a task',
                    'task' => Task::all(),
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => 0 ,
                "message" => 'Invalid Api Key',
                'msg' => $e->getMessage(),
            ]);
        }
    }
    function status(Request $request,$id){
        try{
            $result=Task::find($id)->update($request->all());
            if($result){
                return response()->json([
                    "status" => 1 ,
                    "message" => 'Marked task as done',
                    'data'=>$result,
                    'tasks' => Task::all(),
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => 0 ,
                "message" => 'Invalid Api Key',
                'msg' => $e->getMessage(),
            ]);
        }


    }

    function showtask(Request $request,$userid){
        try{

            $result=Task::where('user_id',$userid)->get();
            if($result){
                return response()->json([
                    "status" => 1 ,
                    "message" => 'Marked task as done',
                    'data'=>$result,
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => 0 ,
                "message" => 'Invalid Api Key',
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
