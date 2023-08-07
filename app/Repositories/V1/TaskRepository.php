<?php 

namespace App\Repositories\V1;
use App\Models\Task;
use Auth;
use App\Interfaces\V1\Task\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    
    private $taskModel;

    // Constructor to inject the Task model instance into the service.
    public function __construct(Task $taskModel)
    {
        $this->taskModel = $taskModel;
    }

    /**
     * Get all tasks belonging to the authenticated user.
     *
     * @return object
     */
    public function getAllTask(): object
    {
        return $this->taskModel->where('user_id', Auth::id())->orderBy('created_at','desc')->get();
    }

 
    
    /**
     * Get a specific task by its ID for the authenticated user.
     *
     * @param int $id The ID of the task to retrieve.
     * @return object
     */
    public function getTaskById(string $id): object
    {
        return $this->taskModel->where('user_id', Auth::id())
            ->where('task_id', $id)->first();
    }

    /**
     * Store a new task for the authenticated user.
     *
     * @param array $data The data for the new task.
     * @return object The created task object.
     */
    public function storeTask(array $data): object
    {
        return $this->taskModel->create($data);
    }

    /**
     * Update an existing task for the authenticated user.
     *
     * @param array $data The data to update the task.
     * @param string $id The ID of the task to be updated.
     * @return bool True if the task is updated successfully, otherwise false.
     */
    public function updateTask(array $data, string $id): bool
    {
        return $this->taskModel->where('user_id', Auth::id())
            ->where('task_id', $id)->update($data);
    }

    /**
     * Update the status of a task for the authenticated user.
     *
     * @param string $newStatus The new status to set for the task.
     * @param string $id The ID of the task to update its status.
     * @return bool True if the status is updated successfully, otherwise false.
     */
    public function updateTaskStatus(string $newStatus, string $id): bool
    {
        $task = $this->taskModel->where('user_id', Auth::id())
            ->where('task_id', $id);

        return $task->update(['status' => $newStatus]);
    }

    /**
     * Delete a task for the authenticated user.
     *
     * @param string $id The ID of the task to be deleted.
     * @return bool True if the task is deleted successfully, otherwise false.
     */
    public function destroyTask(string $id): bool
    {
        return $this->taskModel->where('user_id', Auth::id())
            ->where('task_id', $id)->delete();
    }

}