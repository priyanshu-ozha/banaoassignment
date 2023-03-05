<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
Use Curl;

class UserController extends Controller
{
    function register(){
        return view('register');
    }
    function register_user(Request $request){

   $validated = $request->validate([
    'name' => 'required|alpha',
    'email' => 'required|email|unique:users,email',
    'password' =>'required|min:8'
    ]);
    $obj= new User();

    $obj->name=$request->name;
    $obj->email=$request->email;
    $obj->password=Hash::make($request->password);

    $result= $obj->save();

    if($result)
    {
    return back()->with('success',"SuccessFully Registered!!");
    }else{
        return back()->with('fail',"Something Went Wrong!!");
    }

    }

    function login_user(Request $request){


        $request->validate([
            'email' => 'required|email',
            'password' =>'required'
            ]);



        // $res1=DB::table('users')->where(['email'=>$request->email])->first();
         $res=Auth::attempt(['email'=>$request->email,'password'=>$request->password]);

        if($res){

            $user = Auth::user();

            $token = $user->createToken('myApp')->plainTextToken;

            // $token = $res1->createToken('myToken')->plainTextToken;
            $request->session()->put('mytoken',$token);

            return redirect("dashboard");
        }else{
            return back()->with('fail',"Email/Password is Incorrect!!");
        }



    }

    function dashboard(){
         $id=Auth::id();
         $tasks=Task::where('user_id',$id)->get();
        return view('dashboard',compact('tasks'));
    }

    function logout(){
        //    auth() -> user()-> tokens()-> delete();
    // Auth::user()->tokens()->delete();
    session()->forget('mytoken');
    $user = Auth::user();
    $user->tokens()->delete();
    Auth::logout();


    return redirect('login');
    }
    function login(){
        return view('login');
    }

    function addtasks(Request $request){
        try{

            $request->validate([
               'task'=>'required',
               'user_id' => 'required'
            ]);

            $obj= new Task();
            $obj->user_id=$request->user_id;
            $obj->task=$request->task;
            $result= $obj->save();
            if($result){
                return response()->json([
                    "status" => 1 ,
                    "message" => 'successfully created a task',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => 0 ,
                "message" => 'Invalid Api Key',
                'errors' => $e->getMessage(),
            ]);
        }
    }
    function edit($id){
        $task=Task::find($id);
        if($task){
            return response()->json([
              'status'=>200,
              "task"=>$task
            ]);
        }else{
            return response()->json([
              'status'=>404,
              'message'=>"Task Not Found!!",
            ]);
        }
    }

    function update(Request $request){
        try{
            $result=Task::find($request->id)->update($request->all());
            if($result){
                return response()->json([
                    "status" => 1 ,
                    "message" => 'Updated',
                    'data'=>$result,
                    'session'=>$request->session()->get('mytoken'),
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => 0 ,
                "message" => 'Something Went Wrong',
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
