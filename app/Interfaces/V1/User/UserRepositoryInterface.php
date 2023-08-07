<?php

namespace App\Interfaces\V1\User;

/**
 * Interface UserRepositoryInterface
 *
 * This interface defines the contract for the User Repository.
 */
interface UserRepositoryInterface
{
    /**
     * Store a new user in the repository.
     *
     * @param array $data The data representing the user to be stored.
     * @return bool True on successful storage, false on failure.
     */
    public function storeUser(array $data);
}
