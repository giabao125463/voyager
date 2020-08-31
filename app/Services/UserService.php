<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\HospitalRepository;
use App\Traits\HospitalTrait;

class UserService extends BaseService
{
    /**
     * @var userRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get Doctor users
     *
     * @return collection
     */
    public function all()
    {
        return $this->userRepository->all(['role_id' => setting('super_admin_rold_id', 4)]);
    }
}
