<?php

namespace App\Repositories;

use App\User;
use App\Repositories\BaseRepository;

/**
 * Class CatalogRepository
 *
 * @package App\Repositories
 */

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name', 'email', 'password', 'username', 'settings', 'avatar', 'role_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * Check Doctor name
     *
     * @param string $doctorName
     * @param int $hospitalId
     *
     * @return bool
     */
    public function verifyDoctor($doctorName, $hospitalId)
    {
        $query = $this->model->where('name', $doctorName)->get();
        if ($query->count() > 0) {
            $user = $query->first();

            return $user->hospitals()->where('hospitals.id', $hospitalId)->count() > 0? $user : null;
        }

        return null;
    }

    /**
     * Load doctor list
     *
     * @param User $loginUser
     *
     * @return
     */
    public function getDoctors($loginUser)
    {
        $query = $this->model->with('hospitals');
        $query = $query->where('role_id', setting('doctor_rold_id', 3));
        if (!$loginUser->hasRole('super')) {
            $hospitalIds = $loginUser->hospitals()->pluck('hospitals.id')->toArray();
            $query       = $query->whereHas('hospitals', function ($q) use ($hospitalIds) {
                $q->whereIn('hospital_id', $hospitalIds);
            });
        }

        return $query->get();
    }
}
