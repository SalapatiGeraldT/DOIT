<?php 

namespace App\Repositories\V1;

use App\Interfaces\V1\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    
    private $userModel;

    public function __construct(
        User $userModel
    )
    {
        $this->userModel = $userModel;
    }


    public function storeUser(array $data)
    {
        $this->userModel->create($data);
    }

}