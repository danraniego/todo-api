<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return TaskResource::collection(DB::table('tasks')->where('user_id = ?' . [$id])->get());
        return TaskResource::collection(DB::table('tasks')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Task::create([
            'name' => $request["name"],
            'details' => $request["details"],
            'user_id' => $request["user_id"]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return TaskResource::collection(DB::table('tasks')->where('user_id', $user_id)->get());
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $response = DB::table('tasks')
        ->where('id', $id)
        ->update([
           'name' => $request['name'],
           'details' => $request['name'] 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = DB::table('tasks')->where('id', $id)->delete();

        return [
            'success' => $response
        ];
    }
}
