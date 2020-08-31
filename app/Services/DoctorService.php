<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\HospitalRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Traits\HospitalTrait;

class DoctorService extends BaseService
{
    use HospitalTrait;

    /**
     * @var userRepository
     */
    private $userRepository;

    /** @var HospitalRepository */
    private $hospitalRepository;

    public function __construct(UserRepository $userRepository, HospitalRepository $hospitalRepository)
    {
        $this->userRepository     = $userRepository;
        $this->hospitalRepository = $hospitalRepository;
    }

    /**
     * Create new anket access
     *
     * @param array $input
     * @param string $role
     * @param mixed $parameters
     * @return void
     */
    public function create($parameters)
    {
        $input['name']     = $parameters['username'];
        $input['username'] = $parameters['username'];
        $input['email']    = $parameters['username'] . '@email.generate';
        $input['avatar']   = 'users/default.png';
        $input['role_id']  = setting('doctor_rold_id', 3);
        $input['settings'] = collect(['locale' => 'ja']);
        $input['password'] = Hash::make($parameters['doctor_password']);
        $hospitalIds       = $this->getValidHospitalIds(\Auth::user(), $parameters['hospitals']);

        DB::transaction(function () use ($input, $hospitalIds) {
            $doctor = $this->userRepository->create($input);

            $hospitals = $this->hospitalRepository->getHospitals($hospitalIds);
            $doctor->hospitals()->attach($hospitals);
        });
    }

    /**
     * Update password & hospital
     *
     * @param $input
     * @param mixed $parameters
     * @return void
     */
    public function update($parameters)
    {
        if (!empty($parameters['doctor_password'])) {
            $input['password'] = Hash::make($parameters['doctor_password']);
        }
        $input['id'] = $parameters['id'];
        $hospitalIds = $this->getValidHospitalIds(\Auth::user(), $parameters['hospitals']);

        DB::transaction(function () use ($input, $hospitalIds) {
            $doctor = isset($input['password'])? $this->userRepository->update($input, $input['id']) : $this->userRepository->find($input['id']);
            if (count($hospitalIds) > 0) {
                $hospitals = $this->hospitalRepository->getHospitals($hospitalIds);
                $doctor->hospitals()->sync($hospitals);
            }
        });
    }

    /**
     * Get Doctor users
     *
     * @return collection
     */
    public function all()
    {
        return $this->userRepository->all(['role_id' => setting('doctor_rold_id', 3)]);
    }

    /**
     * Delete doctor in database
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $doctor = $this->userRepository->find($id);
            $doctor->hospitals()->detach();
            $this->userRepository->delete($id);
        });
    }

    /**
     * Load doctor list
     *
     * @param User $loginUser
     *
     * @return collection
     */
    public function getDoctors($loginUser)
    {
        return $this->userRepository->getDoctors($loginUser);
    }

    /**
     * Get hospitalId list
     *
     * @param User $loginUser
     *
     * @return array
     */
    public function getHospitalIds($loginUser)
    {
        return $loginUser->hospitals()->pluck('hospitals.id')->toArray();
    }
}
