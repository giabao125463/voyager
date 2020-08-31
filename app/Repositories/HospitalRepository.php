<?php

namespace App\Repositories;

use App\Models\Hospital;
use App\Repositories\BaseRepository;

/**
 * Class HospitalRepository
 *
 * @package App\Repositories
 */

class HospitalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['name', 'code', 'id'];

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
        return Hospital::class;
    }

    /**
     * Check duplicated hospital
     *
     * @param array $input
     *
     * @return collection
     */
    public function existed($input)
    {
        $query = $this->model->newQuery();
        $query = $query->where('name', $input['name']);
        $query = $query->orWhere('code', $input['code']);

        return $query->get();
    }

    public function getHospitals($ids)
    {
        return $this->model->find($ids);
    }
}
