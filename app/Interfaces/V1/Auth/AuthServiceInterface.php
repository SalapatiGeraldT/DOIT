<?php

namespace App\Interfaces\V1\Auth;

/**
 * Interface AuthServiceInterface
 *
 * This interface defines the contract for the Authentication Service.
 */
interface AuthServiceInterface
{
    /**
     * Generate an API token for the given user.
     *
     * @param mixed $user The user for whom to generate the API token.
     * @return string The generated API token.
     */
    public function generateApiToken($user);
}
