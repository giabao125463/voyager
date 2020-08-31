<?php

namespace App\Repositories;

use App\Models\AnketAccess;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class AnketAccessRepository
 *
 * @package App\Repositories
 */

class AnketAccessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_code',
        'doctor_id',
        'anket_id',
        'qrcode_hash',
        'id'
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
        return AnketAccess::class;
    }

    /**
     * Get login user
     * @param $input
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getLoginUser($input)
    {
        $query = $this->model->newQuery();

        return $query->where('patient_code', $input['username'])->where('password', $input['password'])->get();
    }

    public function updatePatient($input, $id)
    {
        // Check existed patient code
        $query   = $this->model->withTrashed();
        $existed = $query->where('patient_code', $input['patient_code'])->get();
        if ($existed->count() > 0) {
            return null;
        }

        try {
            DB::beginTransaction();
            // Update patient info
            $query = $this->model->withTrashed();
            $model = $query->findOrFail($id);
            $model->fill($input);
            $model->save();
            $model->results()->update(['anket_id' => $input['anket_id']]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }

        return $model;
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
        $query = $this->model->with('hospital', 'doctor');
        if (!$loginUser->hasRole('super')) {
            $hospitalIds = $loginUser->hospitals()->pluck('hospitals.id')->toArray();
            $query       = $query->whereIn('hospital_id', $hospitalIds);
        }

        return $query->get();
    }
}
