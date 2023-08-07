<?php

namespace App\Interfaces\V1\Task;

interface TaskRepositoryInterface 
{
    /**
     * Get all tasks.
     *
     * @return object An object containing the list of tasks.
     */
    public function getAllTask(): object;


    /**
     * Get a specific task by its ID.
     *
     * @param string $id The ID of the task to retrieve.
     * @return object|null An object representing the task if found, null otherwise.
     */
    public function getTaskById(string $id): ?object;

    /**
     * Store a new task in the database.
     *
     * @param array $data An associative array containing the task data to be stored.
     * @return object The newly created task object.
     */
    public function storeTask(array $data): object;

    /**
     * Update a specific task with new data.
     *
     * @param array $data An associative array containing the updated task data.
     * @param string $id The ID of the task to be updated.
     * @return bool True on successful update, false otherwise.
     */
    public function updateTask(array $data, string $id): bool;

    /**
     * Update the status of a specific task.
     *
     * @param string $newStatus The new status to be set for the task.
     * @param string $id The ID of the task to update its status.
     * @return bool True on successful status update, false otherwise.
     */
    public function updateTaskStatus(string $newStatus, string $id): bool;

    /**
     * Delete a specific task from the database.
     *
     * @param string $id The ID of the task to be deleted.
     * @return bool True on successful deletion, false otherwise.
     */
    public function destroyTask(string $id): bool;
}
