<?php

namespace App\Services\V1;

use App\Interfaces\V1\Auth\AuthServiceInterface;

/**
 * Class AuthService
 *
 * This class implements the AuthServiceInterface to provide authentication-related functionality.
 */
class AuthService implements AuthServiceInterface
{
    /**
     * Generate an API token for the given user.
     *
     * @param mixed $user The user for whom to generate the API token.
     * @return array An array containing the generated API token and user's name.
     */
    public function generateApiToken($user)
    {
        $success['token'] = $user->createToken('DOITv1')->plainTextToken;
        $success['name'] = $user->name;
        return $success;
    }
}
