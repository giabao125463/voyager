<?php

namespace App\Repositories;

use App\Models\AnketAccess;
use App\Models\AnketResult;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class AnketResultRepository
 *
 * @package App\Repositories
 */

class AnketResultRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_code',
        'doctor_id',
        'anket_id',
        'qrcode_hash',
        'id',
        'anket_access_id',
        'hospital_id',
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
        return AnketResult::class;
    }

    /**
     * Get Anket Result by Id
     *
     * @param $id String
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAnketResultsByAnketAccessId($id)
    {
        return $this->model->with('anketAccess', 'user')->where('anket_access_id', $id)->get();
    }

    /**
     * Search Anket Result
     *
     * @param $params array
     *
     * @return collection
     */
    public function search($params)
    {
        $query = $this->model->with('anketAccess', 'doctor', 'hospital');

        $query->whereIn('id', function ($q) {
            $q->select(DB::raw('MAX(id) as id'))->from($this->model->getTable())->groupBy('anket_access_id');
        });
        if (!empty($params['patient_code'])) {
            $query->whereHas('anketAccess', function ($query) use ($params) {
                $query->where('patient_code', 'LIKE', '%' . $params['patient_code'] . '%');
            });
        }
        if (!empty($params['doctor_name'])) {
            $query->whereHas('doctor', function ($q) use ($params) {
                $q->where('name', 'LIKE', '%' . $params['doctor_name'] . '%');
            });
        }
        $anket_id = $params['anket_id'];
        if (!empty($anket_id) && $anket_id != 'all') {
            if (!is_array($anket_id)) {
                $anket_id = [$anket_id];
            }
            $query->whereIn('anket_id', $anket_id);
        }
        $hospital_id = $params['hospitals'];
        if (!empty($hospital_id)) {
            $query->whereIn('hospital_id', $hospital_id);
        } elseif (!\Auth::user()->hasRole('super')) {
            $hospital_id = \Auth::user()->hospitals()->pluck('hospitals.id')->toArray();
            $query->whereIn('hospital_id', $hospital_id);
        }
        $query->orderBy('created_at', 'DESC');

        return $query->get();
    }

    /**
     * Get latest anket result from history
     *
     * @param $id string
     * @param mixed $resultId
     *
     * @return model
     */
    public function getLastestAnketResult($resultId)
    {
        $query = $this->model->newQuery();
        $query->where('anket_access_id', function ($q) use ($resultId) {
            $q->select('anket_access_id')->from($this->model->getTable())->where('id', $resultId);
        });
        $query->orderBy('created_at', 'DESC');

        return $query->first();
    }
}
