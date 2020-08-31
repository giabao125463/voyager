<?php

namespace App\Services;

use App\Repositories\HospitalRepository;

class HospitalService extends BaseService
{
    /**
     * @var HospitalRepository
     */
    private $hospitalRepository;

    /**
     * HospitalService constructor
     *
     * @param HospitalRepository $hospitalRepository
     */
    public function __construct(HospitalRepository $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }

    /**
     * Create new hospital
     *
     * @param array $input
     * @return \App\Models\Hospital
     */
    public function create($input)
    {
        return $this->hospitalRepository->create($input);
    }

    /**
     * Check duplicated hospital
     *
     * @param array $input
     *
     * @return string Status
     */
    public function existed($input)
    {
        $hospitals = $this->hospitalRepository->existed($input);
        if ($hospitals->count() > 0) {
            $hospital = $hospitals->first();
            if ($hospital->id != $input['id']) {
                return $hospital->name == $input['name']? 'name' : 'code';
            }
        }

        return '';
    }

    /**
     * Get all hospital in database
     *
     * @return collection
     */
    public function all()
    {
        return $this->hospitalRepository->all();
    }

    /**
     * Update Hospital information
     *
     * @param array $input
     *
     * @return model
     */
    public function update($input)
    {
        return $this->hospitalRepository->update($input, $input['id']);
    }

    /**
     * Delete Hospital in database
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id)
    {
        return $this->hospitalRepository->delete($id);
    }

    /**
     * Get Doctors by Hospital ID
     *
     * @param int $id
     *
     * @return bool
     */
    public function getDoctor($id)
    {
        return $this->hospitalRepository->find($id)->doctors()->get();
    }

    /**
     * Get Hospital info
     *
     * @param int $id
     *
     * @return bool
     */
    public function getHospital($id)
    {
        return $this->hospitalRepository->find($id);
    }

    public function search($id)
    {
        return $this->hospitalRepository->all(['id' => $id]);
    }
}
