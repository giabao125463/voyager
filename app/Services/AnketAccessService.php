<?php

namespace App\Services;

use App\Repositories\AnketAccessRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Session;

class AnketAccessService extends BaseService
{
    /**
     * @var AnketAccessRepository
     */
    private $anketAccessRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AnketAccessService constructor.
     *
     * @param AnketAccessRepository $anketAccessRepository
     * @param UserRepository $userRepository
     */
    public function __construct(AnketAccessRepository $anketAccessRepository, UserRepository $userRepository)
    {
        $this->anketAccessRepository = $anketAccessRepository;
        $this->userRepository        = $userRepository;
    }

    /**
     * Create new anket access
     *
     * @param array $input
     * @return \App\Models\AnketAccess
     */
    public function create($input)
    {
        $ankets = $this->anketAccessRepository->all(['patient_code' => $input['patient_code'], 'anket_id' => $input['anket_id']]);
        if ($ankets->count() > 0) {
            // update anket-access
            return $this->anketAccessRepository->update($input, $ankets->first()->id);
        } else {
            // create new anket-access
            $stringToHash         = $input['patient_code'] . $input['hospital_id'] . $input['anket_id'] . $input['doctor_id'];
            $input['qrcode_hash'] = preg_replace('/[^A-Za-z0-9\-]/', '', Hash::make($stringToHash));

            return $this->anketAccessRepository->create($input);
        }
    }

    /**
     *  authenticate user
     *
     * @param $input
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function authenticate($input)
    {
        $anketAccesses = $this->anketAccessRepository->getLoginUser($input);
        if ($anketAccesses->count() == 0) {
            return null;
        }

        if ($anketAccesses->count() == 1) {
            $result = $anketAccesses->first();
        } else {
            if (!session()->has('SEL_ANKET_ID')) {
                return null;
            }

            $result = $anketAccesses->where('anket_id', session('SEL_ANKET_ID'))->first();
        }

        session(['PATIENT_ACCESS' => $result->qrcode_hash]);
        session(['PATIENT_ID' => $result->id]);
        session()->forget('SEL_ANKET_ID');

        return $result;
    }

    /**
     * Validate session
     * @param $request
     * @return bool
     */
    public function validateSession()
    {
        if (session::has('PATIENT_ACCESS')) {
            $search['qrcode_hash'] = session('PATIENT_ACCESS');

            return $this->anketAccessRepository->all($search)->first();
        }

        return false;
    }

    /**
     * Return Anket View
     *
     * @return string | null
     */
    public function redirect()
    {
        $access = $this->validateSession();
        if ($access) {
            session()->forget('ANKET_RESULT_ID');
            session(['PATIENT_ID' => $access->id]);

            return redirect()->route('anket.create', ['anketId' => $access->anket_id]);
        }
        abort(404);
    }

    /**
     * Get anket by id
     *
     * @param $id
     * @return model
     */
    public function getAnketById($id)
    {
        return $this->anketAccessRepository->find($id);
    }

    /**
     * Update anket
     *
     * @param $input
     * @return \App\Repositories\Builder|\App\Repositories\Builder[]|\App\Repositories\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateAnket($input)
    {
        return $this->anketAccessRepository->update($input, $input['id']);
    }

    /**
     * Search Anket
     *
     * @param $search array
     *
     * @return model
     */
    public function searchFirstAnket($search)
    {
        return $this->anketAccessRepository->all($search)->first();
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
        return $this->userRepository->verifyDoctor($doctorName, $hospitalId);
    }

    /**
     * Update patient
     *
     * @param $input array
     * @return Model|null
     */
    public function updatePatient($input)
    {
        return $this->anketAccessRepository->updatePatient($input, $input['id']);
    }

    /**
     * Load Anket Access list
     *
     * @param User $loginUser
     *
     * @return collection
     */
    public function getAnketAccesses($loginUser)
    {
        return $this->anketAccessRepository->getAnketAccesses($loginUser);
    }

    /**
     * Delete Anket Access from DB
     *
     * @param int $id
     *
     * @return model
     */
    public function delete($id)
    {
        return $this->anketAccessRepository->delete($id);
    }
}
