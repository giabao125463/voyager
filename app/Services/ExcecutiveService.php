<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class ExcecutiveService extends BaseService
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
     * Create new anket access
     *
     * @param array $input
     * @param string $role
     * @return \App\Models\AnketAccess
     */
    public function create($input)
    {
        $input['name']     = $input['username'];
        $input['email']    = $input['username'] . '@email.generate';
        $input['avatar']   = 'users/default.png';
        $input['role_id']  = setting('role_super_user', 4);
        $input['settings'] = collect(['locale' => 'ja']);
        $input['password'] = Hash::make($input['doctor_password']);

        return $this->userRepository->create($input);
    }

    /**
     * Update password
     *
     * @param $input
     * @return \App\Repositories\Builder|\App\Repositories\Builder[]|\App\Repositories\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($input)
    {
        $input['password'] = Hash::make($input['doctor_password']);

        return $this->userRepository->update($input, $input['id']);
    }
}
