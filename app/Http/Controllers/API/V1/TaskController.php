<?php

namespace App\Http\Controllers\API\V1;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use CoreJsonResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $completed_tasks = $client->tasks()->where("completed", true)->get()->all();
        $not_completed_tasks = $client->tasks()->where("completed", false)->get()->all();
        return $this->ok(["incomplete" => $not_completed_tasks, "completed" => $completed_tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::where("id", auth("sanctum")->user()->id)->first();

        $request->validate([
            "desc" => ["nullable", "string"], "summary" => ["required", "string"], "due_date" => ["nullable"]
        ]);
        $task = Task::create([
            "summary" => $request->summary,
            "desc" => $request->desc,
            "due_date" => $request->due_date,
            "client_id" => $client->id,
            "created_at" => now()

        ]);
        $client->last_updated = now();
        $client->save();
        return $this->created(["task" => $task]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $task = $client->tasks()->find($id);
        if ($task) {
            return $this->ok(["task" => $task]);
        }
        return $this->notFound(["message" => "task not found"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $task = $client->tasks()->find($id);
        if ($task) {
            $task->update($request->all());
            $task->save();
            return $this->created(["task" => $task]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::where("id", auth("sanctum")->user()->id)->first();
        $task = $client->tasks()->find($id);
        if ($task) {
            $task->delete();
            return $this->ok(["task deleted"]);
        }
    }
}
