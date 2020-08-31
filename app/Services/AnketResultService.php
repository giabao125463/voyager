<?php

namespace App\Services;

use App\Repositories\AnketResultRepository;
use App\Repositories\AnketAccessRepository;
use App\Http\Requests\AnketRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnketResultExport;

class AnketResultService extends BaseService
{
    /**
     * @var AnketResultRepository
     */
    private $anketResultRepository;

    /**
     * @var AnketAccessRepository
     */
    private $anketAccessRepository;

    private $colQuantity;

    /**
     * AnketAccessService constructor.
     * @param AnketResultRepository $anketResultRepository
     * @param AnketAccessRepository $anketAccessRepository
     */
    public function __construct(AnketResultRepository $anketResultRepository, AnketAccessRepository $anketAccessRepository)
    {
        $this->anketResultRepository = $anketResultRepository;
        $this->anketAccessRepository = $anketAccessRepository;
    }

    public function getAnketResultsByAnketAccessId($anketAccessId)
    {
        return $this->anketResultRepository->getAnketResultsByAnketAccessId($anketAccessId);
    }

    /**
     * Create new Anket result
     *
     * @param AnketRequest $request
     * @return string
     */
    public function create(AnketRequest $request)
    {
        $execStatus = '';
        $data       = $request->getAnketInput();
        $input      = [];
        $hasData    = false;
        $anketAccessId;
        // Check update Anket Result
        $resultId = session('ANKET_RESULT_ID');
        if (isset($resultId)) {
            $anketResult = $this->anketResultRepository->find($resultId);
            if ($anketResult && \Auth::user()) {
                $input = [
                    'anket_access_id' => $anketResult->anket_access_id,
                    'doctor_id'       => $anketResult->doctor_id,
                    'anket_id'        => $anketResult->anket_id,
                    'hospital_id'     => $anketResult->hospital_id,
                    'created_by'      => \Auth::user()->id,
                    'answers'         => json_encode($data)
                ];
                $hasData    = true;
                $execStatus = 'update';
            }
        } else {
            $anketAccess = null;
            if (session()->has('ANKET_ID') && session()->has('DOCTOR_ID') && session()->has('HOSPITAL_ID')) {
                $anketAccess = $this->createAnketAccess();
            } else {
                $anketAccess = $this->anketAccessRepository->find(session('PATIENT_ID'));
            }

            // Create Anket Result
            if (isset($anketAccess)) {
                $anketAccessId = $anketAccess->id;
                $input         = [
                    'anket_access_id' => $anketAccessId,
                    'doctor_id'       => $anketAccess->doctor_id,
                    'anket_id'        => $anketAccess->anket_id,
                    'hospital_id'     => $anketAccess->hospital_id,
                    'answers'         => json_encode($data)
                ];
                $hasData    = true;
                $execStatus = 'create';
            }
        }
        if ($hasData) {
            $result = $this->anketResultRepository->create($input);
            if (isset($result)) {
                // Disable patient access to survey
                if (isset($anketAccessId)) {
                    $this->anketAccessRepository->find($anketAccessId)->delete();
                    session()->forget('PATIENT_ID');
                    session()->forget('PATIENT_ACCESS');
                    session()->forget('ANKET_ID');
                    session()->forget('HOSPITAL_ID');
                    session()->forget('DOCTOR_ID');
                    session()->forget('DOCTOR_NAME');
                } else {
                    session()->forget('ANKET_RESULT_ID');
                }
            }
        }

        return $execStatus;
    }

    /**
     * Create Anket Acess for new patient
     *
     * @return model
     */
    private function createAnketAccess()
    {
        $input['anket_id']     = session('ANKET_ID');
        $input['hospital_id']  = session('HOSPITAL_ID');
        $input['patient_code'] = session('DOCTOR_NAME') . '_' . date('Ymd_His');
        $input['password']     = Str::random(6);
        $input['doctor_id']    = session('DOCTOR_ID');

        $newAnket             = $this->anketAccessRepository->create($input);
        $stringToHash         = $newAnket->id . $newAnket->patient_code . $newAnket->doctor_id;
        $input['qrcode_hash'] = preg_replace('/[^A-Za-z0-9\-]/', '', Hash::make($stringToHash));

        return $this->anketAccessRepository->update($input, $newAnket->id);
    }

    /**
     * Get Anket Result By Id
     *
     * @param $id string
     *
     * @return model
     */
    public function getAnketResult($id)
    {
        return $this->anketResultRepository->find($id);
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
        return $this->anketResultRepository->search($params);
    }

    /**
     * Get latest anket result from history
     *
     * @param $id string
     *
     * @return model
     */
    public function getLastestAnketResult($id)
    {
        return $this->anketResultRepository->getLastestAnketResult($id);
    }

    /**
     * Get Anket Result by Hospital ID
     *
     * @param $id string
     *
     * @return model
     */
    public function getAnketResultByHospitalId($id)
    {
        return $this->anketResultRepository->all(['hospital_id' => $id]);
    }

    /**
     * Get Anket Result by Doctor ID
     *
     * @param $id string
     *
     * @return model
     */
    public function getAnketResultByDoctorId($id)
    {
        return $this->anketResultRepository->all(['doctor_id' => $id]);
    }

    /**
     * Export Ankert results to csv
     *
     * @param $params
     * @param $anket_id
     *
     * @return void
     */
    public function exportCSV($params, $anket_id)
    {
        if ($params['anket_id'] == 'all' && $anket_id == 'anket_39') {
            $params['anket_id'] = [$anket_id, 'anket_39_temp'];
        } else if ($params['anket_id'] == 'anket_39_temp' && $anket_id == 'anket_39') {
            $params['anket_id'] = ['anket_39_temp'];
        } else if ($params['anket_id'] == 'all' || $params['anket_id'] == $anket_id) {
            $params['anket_id'] = $anket_id;
        } else {
            $params['anket_id'] = 'anket'; // Give some ID that not exists
        }

        $anketResults = $this->search($params);
        if ($anketResults->count() > 0) {
            $this->colQuantity = $this->prepareColQuantity($anketResults, $anket_id);
            $anketExportData   = $this->prepareDataToExport($anketResults);
            $fileName          = date('YmdHi') . '.csv';

            return Excel::download(new AnketResultExport($anket_id, $anketExportData, $this->colQuantity), $fileName);
        }

        return redirect()->back()->with([
            'message'    => "データを見つかりません",
            'alert-type' => 'error',
        ]);
    }

    /**
     * Prepare quantity of cancer question and pregnancy question
     *
     * @param $anketResults
     * @param $anket_id
     *
     * @return array
     */
    private function prepareColQuantity($anketResults, $anket_id)
    {
        $qaCancer    = 0;
        $qaPregnancy = 0;
        foreach ($anketResults as $anketResult) {
            $answers = json_decode($anketResult->answers);
            switch ($anket_id) {
                case "anket_39":
                    $max      = $this->getQuantity($answers->qa19);
                    $qaCancer = $max > $qaCancer ? $max : $qaCancer;
        
                    $max         = $this-> getQuantity($answers->qa25);
                    $qaPregnancy = $max > $qaPregnancy ? $max : $qaPregnancy;
                break;
                case "anket_26":
                    $max      = $this->getQuantity($answers->qa7);
                    $qaCancer = $max > $qaCancer ? $max : $qaCancer;
        
                    $max         = $this-> getQuantity($answers->qa14);
                    $qaPregnancy = $max > $qaPregnancy ? $max : $qaPregnancy;
                break;
            }
        }

        return [
            "qaCancer"    => $qaCancer,
            "qaPregnancy" => $qaPregnancy,
        ];
    }

    /**
     * Get count of data
     *
     * @param $answers
     *
     * @return int
     */
    private function getQuantity($answers)
    {
        $max = 0;
        foreach ($answers as $key => $value) {
            if (count(array_filter(get_object_vars($value))) > 0) {
                $max = ++$key;
            }
        }

        return $max;
    }

    /**
     * Prepare data to export
     *
     * @param $anketResults
     *
     * @return array
     */
    private function prepareDataToExport($anketResults)
    {
        $anketExportData = [];
        foreach ($anketResults as $anketResult) {
            $answers           = json_decode($anketResult->answers);
            $anketExportData[] = $this->getAnketData($anketResult, $answers);
        }

        return $anketExportData;
    }

    /**
     * Get csv data base on Anket type
     *
     * @param $anketResult
     * @param $answers
     *
     * @return array
     */
    private function getAnketData($anketResult, $answers)
    {
        $anketId = Str::replaceFirst(config('consts.anketo.suffix_temporary'), '', $anketResult->anket_id);
        switch ($anketId) {
            case 'anket_26':
                return $this->getAnket26($anketResult, $answers);
            case 'anket_39':
                return $this->getAnket39($anketResult, $answers);
            default:
                return [];
        }
    }

    /**
     * Get data for LUNA3_患者アンケート_追跡時
     *
     * @param $anketResult
     * @param $answers
     *
     * @return array
     */
    private function getAnket26($anketResult, $answers)
    {
        $qa10 = $answers->qa10;

        return array_merge(
            $this->getCommonInfo($anketResult),
            [
                isset($answers->drugCheck) ? $answers->drugCheck : $answers->drugDescriptions, //qa1
                $answers->qa2 ?? '',
                $answers->qa3 ?? '',
                $answers->qa4 ?? '',
                $answers->qa5 ?? '',
                $answers->qa6 ?? ''
            ],
            $this->getCancerData($answers->qa7),
            $this->getDiseasesData($answers), // qa8
            [
                $answers->qa9,
                $qa10->item1,
                $qa10->item2,
                $qa10->item3,
                $qa10->item4,
                $qa10->item5,
                $qa10->item6,
                $qa10->item7,
                isset($answers->qa11)? $this->getAmenorrhea($answers->qa11) : '',
                $answers->qa12 ?? '',
                $answers->qa13 ?? '',
            ],
            $this->getPrenancyData($answers->qa14),
            [
                $answers->qa15 ?? '',
                $answers->qa16 ?? '',
                $answers->qa17 ?? '',
                $answers->qa18 ?? '',
                $answers->qa19 ?? '',
                $answers->qa20 ?? '',
                $answers->qa21 ?? '',
                $answers->qa22 ?? '',
                $answers->qa23 ?? '',
                $answers->qa24 ?? '',
                $answers->qa25 ?? ''
            ],
            $this->getUnderstanding($answers->qa26),
            $this->getAnketLupus($answers),
            $this->getAnketSF12($answers)
        );
    }


    /**
     * Get data for LUNA3_患者アンケート_登録時_矢嶋修正
     *
     * @param $anketResult
     * @param $answers
     *
     * @return array
     */
    private function getAnket39($anketResult, $answers)
    {
        return array_merge(
            $this->getCommonInfo($anketResult),
            [
                $answers->gender ?? '', // qa1
                isset($answers->qa2)? $answers->qa2->year : '',
                isset($answers->qa2)? $answers->qa2->month : '',
                isset($answers->qa3)? $answers->qa3 : '',
                isset($answers->qa4)? $answers->qa4->height: '',
                isset($answers->qa4)? $answers->qa4->weight: '',
                $answers->qa5 ?? '',
                isset($answers->qa6a->ml)? $answers->qa6a->ml: '',
                isset($answers->qa6b->ml)? $answers->qa6b->ml: '',
                isset($answers->qa6c->ml)? $answers->qa6c->ml: '',
                isset($answers->qa6d->ml)? $answers->qa6d->ml: '',
                isset($answers->qa6e->ml)? $answers->qa6e->ml: '',
                isset($answers->qa6f->ml)? $answers->qa6f->ml: '',
                $answers->qa7 ?? '',
                isset($answers->qa8->ageFrom)? $answers->qa8->ageFrom: '',
                isset($answers->qa8->ageTo)? $answers->qa8->ageTo: '',
                isset($answers->qa8->quantity)? $answers->qa8->quantity: '',
                isset($answers->qa9->age)? $answers->qa9->age: '',
                isset($answers->qa9->quantity)? $answers->qa9->quantity: '',
                $answers->qa10 ?? '',
                $answers->qa11 ?? '',
                $answers->qa11Other ?? '',
                $answers->qa12 ?? '',
                isset($answers->drugCheck) ? $answers->drugCheck : $answers->drugDescriptions, // qa13
                $answers->qa14 ?? '',
                $answers->qa15 ?? '',
                $answers->qa16 ?? '',
                $answers->qa17 ?? '',
                $answers->qa18 ?? '',
            ],
            $this->getCancerData($answers->qa19),
            $this->getDiseasesData($answers),
            $this->getInfections($answers),
            [
                isset($answers->qa22)? $this->getAmenorrhea($answers->qa22) : '',
                $answers->qa23 ?? '',
                isset($answers->qa24) ? $answers->qa24 : '',
            ],
            $this->getPrenancyData($answers->qa25),
            [
                $answers->qa26 ?? '',
                $answers->qa27 ?? '',
                $answers->qa28 ?? '',
                $answers->qa29 ?? '',
                $answers->qa30 ?? '',
                $answers->qa31 ?? '',
                $answers->qa32 ?? '',
                $answers->qa33 ?? '',
                $answers->qa34 ?? '',
                $answers->qa35 ?? '',
                $answers->qa36 ?? '',
                $answers->qa37 ?? '',
                $answers->qa38 ?? ''
            ],
            $this->getUnderstanding($answers->qa39),
            $this->getAnketLupus($answers),
            $this->getAnketSF12($answers)
        );
    }

    /**
     * Get data for 日本語版LupusPRO
     *
     * @param $answers
     *
     * @return array
     */
    private function getAnketLupus($answers)
    {
        $points = [
            '1' => '全くない',
            '2' => 'たまにある',
            '3' => '時々ある',
            '4' => '度々ある',
            '5' => '常にある',
            '6' => 'あてはまらない'
        ];

        return array_merge(
            $this->getCheckedValues($answers->lpusqaA, $points),
            $this->getCheckedValues($answers->lpusqaB, $points),
            $this->getCheckedValues($answers->lpusqaC, $points),
            $this->getCheckedValues($answers->lpusqaD, $points),
            $this->getCheckedValues($answers->lpusqaE, $points),
            $this->getCheckedValues($answers->lpusqaF, $points),
            $this->getCheckedValues($answers->lpusqaG, $points),
            $this->getCheckedValues($answers->lpusqaH, $points)
        );
    }

    /**
     * Get data for SF-12v2日本語版
     *
     * @param $answers
     *
     * @return array
     */
    private function getAnketSF12($answers)
    {
        $activitiesPoints = [
            '1' => 'いつも',
            '2' => 'ほとんどいつも',
            '3' => 'ときどき',
            '4' => 'まれに',
            '5' => 'ぜんぜんない'
        ];

        return array_merge(
            [$answers->sf12qa1 ?? ''],
            $this->getCheckedValues($answers->sf12qa2, ['1' => 'とてもむずかしい', '2' => '少しむずかしい', '3' => 'ぜんぜんむずかしくない']),
            $this->getCheckedValues($answers->sf12qa3, $activitiesPoints),
            $this->getCheckedValues($answers->sf12qa4, $activitiesPoints),
            [$answers->sf12qa5 ?? ''],
            $this->getCheckedValues($answers->sf12qa6, $activitiesPoints),
            [$answers->sf12qa7 ?? '']
        );
    }

    /**
     * Get 基本情報
     *
     * @param $anketResult
     *
     * @return array
     */
    private function getCommonInfo($anketResult)
    {
        $created_at = date_format($anketResult->created_at, "Ymd");

        return [
            $created_at,
            $anketResult->anketAccess->patient_code,
        ];
    }

    /**
     * Get cancer data
     *
     * @param $cancerData
     *
     * @return array
     */
    private function getCancerData($cancerData)
    {
        $result              = [];
        $cols                = 6;
        $qaCancerColQuantity = $this->colQuantity['qaCancer'] != 0 ? $this->colQuantity['qaCancer'] : 1;
        $result              = array_fill(0, $cols * $qaCancerColQuantity, '');

        foreach ($cancerData as $key => $value) {
            if (isset($value) && $key < $qaCancerColQuantity) {
                $index              = $key * $cols;
                $answer             = $cancerData[$key];
                $result[$index]     = isset($answer->typeOfCancer) ? $answer->typeOfCancer : '';
                $result[$index + 1] = isset($answer->diagnosisYear) ? $answer->diagnosisYear : '';
                $result[$index + 2] = isset($answer->diagnosisMonth) ? $answer->diagnosisMonth : '';
                $result[$index + 3] = isset($answer->stateTreatment) ? $answer->stateTreatment : '';
                $treatments         = [];
                if (isset($answer->cancerTreatment)) {
                    $treatment = $answer->cancerTreatment;
                    if (isset($treatment->val1)) {
                        $treatments[] = $treatment->val1;
                    }
                    if (isset($treatment->val2)) {
                        $treatments[] = $treatment->val2;
                    }
                    if (isset($treatment->val3)) {
                        $treatments[] = $treatment->val3;
                    }
                    if (isset($treatment->val4)) {
                        $treatments[] = $treatment->val4;
                    }
                }
                $result[$index + 4] = $this->convertToString($treatments);
                $result[$index + 5] = isset($answer->cancerTreatmentOther) ? $answer->cancerTreatmentOther : '';
            }
        }

        return $result;
    }

    /**
     * Get disease data from answers
     *
     * @param $answers
     *
     * @return array
     */
    private function getDiseasesData($answers)
    {
        $result = array_fill(0, 19, '');
        if (isset($answers->diagnosedDiseases)) {
            $result[0] = '特になし';
        } else {
            $oneTimes   = '1回';
            $multiTimes = '2回以上';
            $checked    = '1';
            $unChecked  = '0';

            // 目の病気
            $result[1] = isset($answers->diseaseEyeCataract) ? $answers->diseaseEyeCataract : $unChecked;
            $result[2] = isset($answers->diseaseEyeVisualLoss) ? $answers->diseaseEyeVisualLoss : $unChecked;
            // 脳の病気
            if (isset($answers->diseaseCerebralInfarction)) {
                $result[3] = $answers->diseaseCerebralInfarction == $checked ? $oneTimes : $multiTimes;
            }

            if (isset($answers->diseaseCerebralHemorrhage)) {
                $result[4] = $answers->diseaseCerebralHemorrhage == $checked ? $oneTimes : $multiTimes;
            }

            // 腎臓の病気
            $result[5] = isset($answers->diseaseKidneyDialysis) ? $answers->diseaseKidneyDialysis : $unChecked;
            $result[6] = isset($answers->diseaseKidneyTransplant) ? $answers->diseaseKidneyTransplant : $unChecked;

            // 心臓の病気
            $result[7] = isset($answers->diseaseHeartAngina) ? $answers->diseaseHeartAngina : $unChecked;
            $result[8] = isset($answers->diseaseHeartCoronarySurgery) ? $answers->diseaseHeartCoronarySurgery : $unChecked;
            if (isset($answers->diseaseHeartInfarction)) {
                $result[9] = $answers->diseaseHeartInfarction == $checked ? $oneTimes : $multiTimes;
            }
            
            // 末梢血管の病気
            $result[10] = isset($answers->diseaseVascularLameness) ? $answers->diseaseVascularLameness : $unChecked;

            if (isset($answers->diseaseVascularTissueLoss)) {
                if (isset($answers->diseaseVascularTissueLossLocation)) {
                    $result[11] = $answers->diseaseVascularTissueLossLocation == $checked ?  '1箇所' : '2箇所以上';
                }
            }

            // 消化管の病気
            if (isset($answers->diseaseDigestResection)) {
                $result[12] = $answers->diseaseDigestResection == $checked ? $oneTimes : $multiTimes;
            }
            $result[13] = isset($answers->diseaseDigestStomach) ? $answers->diseaseDigestStomach : $unChecked;


            // 筋肉や骨の病気
            $result[14] = isset($answers->diseaseBoneOsteoporosis) ? $answers->diseaseBoneOsteoporosis : $unChecked;
            if (isset($answers->diseaseBoneNecrosis)) {
                $result[15] = $answers->diseaseBoneNecrosis == $checked ? $oneTimes : $multiTimes;
            }
            // 皮膚の病気
            $result[16] = isset($answers->diseaseSkinUlcer) ? $answers->diseaseSkinUlcer : $unChecked;
            // その他
            $result[17] = isset($answers->diseaseOthersDiabetes) ? $answers->diseaseOthersDiabetes : $unChecked;
            if (isset($answers->diseaseOthersTumor)) {
                $result[18] = $answers->diseaseOthersTumor == $checked ? $oneTimes : $multiTimes;
            }
        }

        return $result;
    }

    /**
     * Get infections data from answer
     *
     * @param $answers
     *
     * @return array
     */
    private function getInfections($answers)
    {
        $result = array_fill(0, 15, '');
        if (isset($answers->diagnosedInfection)) {
            $result[0] = '特になし';
        } else {
            $result[1]  = ($answers->infectionPneumoniaAge ?? '');
            $result[2]  = ($answers->infectionSepsisAge ?? '');
            $result[3]  = ($answers->infectionArthritisAge ?? '');
            $result[4]  = ($answers->infectionPyelonephritisAge ?? '');
            $result[5]  = ($answers->infectionOsteomyelitisAge ?? '');
            $result[6]  = (isset($answers->infectionHerpesZoster)? $answers->infectionHerpesZosterAge : '') ;
            $result[7]  = (isset($answers->infectionCellulitis)? $answers->infectionHerpesZosterAge : '');
            $result[8]  = ($answers->infectionPeritonitisAge ?? '');
            $result[9]  = isset($answers->infectionOther1Name)? $answers->infectionOther1Name : '';
            $result[10] = isset($answers->infectionOther1Age)? $answers->infectionOther1Age : '';
            $result[11] = isset($answers->infectionOther2Name)? $answers->infectionOther2Name : '';
            $result[12] = isset($answers->infectionOther2Age)? $answers->infectionOther2Age : '';
            $result[13] = isset($answers->infectionOther3Name)? $answers->infectionOther3Name : '';
            $result[14] = isset($answers->infectionOther3Age)? $answers->infectionOther3Age : '';
        }

        return $result;
    }

    /**
     * Get Amenorrhea data from answer
     *
     * @param $data
     *
     * @return string
     */
    private function getAmenorrhea($data)
    {
        if (isset($data->ageAbove40)) {
            return $data->ageAbove40 == '0'? '40歳未満' : ' 40歳以上';
        }

        return $data->ovarianDiagnosed;
    }

    /**
     * Get Prenancy data from answer
     *
     * @param $data
     *
     * @return array
     */
    private function getPrenancyData($data)
    {
        $cols                   = 9;
        $qaPregnancyColQuantity = $this->colQuantity['qaPregnancy'] != 0 ? $this->colQuantity['qaPregnancy'] : 1;
        $result                 = array_fill(0, $cols * $qaPregnancyColQuantity, '');
        foreach ($data as $key => $answer) {
            if (isset($answer->age)) {
                $index              = $key * $cols;
                $result[$index]     = isset($answer->age) ? $answer->age : '';
                $result[$index + 1] = isset($answer->year) ? $answer->year : '';
                $result[$index + 2] = isset($answer->month) ? $answer->month : '';
                $result[$index + 3] = isset($answer->day) ? $answer->day : '';
                $result[$index + 4] = isset($answer->pregnancyWeek) ? $answer->pregnancyWeek : '';
                $statuIndex         = $index + 5;
                if (isset($answer->pregnancyStatus)) {
                    switch ($answer->pregnancyStatus) {
                        case '1':
                            $result[$statuIndex] = '現在妊娠中';
                            break;
                        case '2':
                            $result[$statuIndex] = '早期流産';
                            if (isset($answer->miscarriageNatural)) {
                                $result[$statuIndex] .= ($answer->miscarriageNatural == '1' ? '（自然流産）' : '（人工流産）');
                            }
                            break;
                        case '3':
                            $result[$statuIndex] = '後期流産';
                            break;
                        case '4':
                            $result[$statuIndex] = '子宮内胎児死亡';
                            break;
                        case '5':
                            $result[$statuIndex] = '生児出産 ';
                            if (isset($answer->liveBirthPreterm)) {
                                $result[$statuIndex] .= ($answer->liveBirthPreterm == '1' ? '(早産）' : '(正期産）');
                            }
                            break;
                        default:
                            $result[$statuIndex] = '';
                            break;
                    }
                }
                $result[$index + 6] = isset($answer->syndromeHypertension) ? $answer->syndromeHypertension : '0';
                $result[$index + 7] = isset($answer->syndromeUteroRetardation) ? $answer->syndromeUteroRetardation : '0';
                $result[$index + 8] = isset($answer->syndromeGestationalDiabetes) ? $answer->syndromeGestationalDiabetes : '0';
            }
        }

        return $result;
    }

    /**
     * Get Understanding data
     *
     * @param $answers
     *
     * @return array
     */
    private function getUnderstanding($answers)
    {
        $points = [
            '1' => 'まったくあてはまらない',
            '2' => 'どちらかといえばあてはまらない',
            '3' => 'どちらかといえばあてはまらない',
            '4' => 'ややあてはまる',
            '5' => 'たいへんよくあてまる',
        ];
        $result = [];
        foreach ($answers as $answer) {
            $result[] = $points[$answer->understand];
        }

        return $result;
    }

    /**
     * Get checked value from answers
     *
     * @param array $answers
     * @param array $points
     *
     * @return array
     */
    private function getCheckedValues($answers, $points)
    {
        $result = [];
        foreach ($answers as $answer) {
            $result[] = $points[$answer->val];
        }

        return $result;
    }

    /**
     * Convert array to string
     *
     * @param $data array
     * @param $delimiter string
     *
     * @return string
     */
    private function convertToString($data, $delimiter = ';')
    {
        return count($data) > 0? implode($data, $delimiter) : '';
    }

    /**
     * Add suffix for text
     *
     * @param $content string
     * @param $suffix string
     *
     * @return string
     */
    private function formatSuffix($content, $suffix = ' 日')
    {
        return isset($content)? $content . $suffix : '';
    }
}
