<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\TaskResource;

use App\Http\Requests\V1\TaskStoreRequest;

use App\Repositories\V1\TaskRepository;


class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->taskRepository->getAllTask();
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $result = $this->taskRepository->storeTask($request->validated());
        return ($result) ? response()->json('Task created!') : response()->json('Task creation failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->taskRepository->getTaskById($id);
        return new TaskResource($task); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, $id)
    {
        // Validate the incoming request data using the TaskStoreRequest rules
        $validatedData = $request->validated();

        // Update the task in the task repository using the validated data
        $result = $this->taskRepository->updateTask($validatedData, $id);

        // Return a JSON response indicating the successful update of the task
        return ($result) ? response()->json('Task updated!') : response()->json('Task update failed!');
    }



    public function updateStatus(Request $request, $id , $newStatus)
    {
        $result = $this->taskRepository->updateTaskStatus($newStatus, $id);
        return ($result) ? response()->json('Task status updated!') : response()->json('Task status update failed!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->taskRepository->destroyTask($id);
        return ($result) ? response()->json('Task deleted!') : response()->json('Task deletion failed!');
    }
}
