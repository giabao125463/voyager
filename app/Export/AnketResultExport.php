<?php

namespace App\Exports;

use App\Models\AnketResult;
use Maatwebsite\Excel\Concerns\FromArray;

class AnketResultExport implements FromArray
{
    /** @var collection */
    private $anketResults;

    /** @var string */
    private $anketId;

    /** @var collection */
    private $colQuantity;

    /** @var array */
    public $header = [];

    /** @var string */
    public $anket39_cancerQaIndex    = '１９';
    public $anket39_pregnancyQaIndex = '２５';
    public $anket26_cancerQaIndex    = '７';
    public $anket26_pregnancyQaIndex = '１４';

    /**
     * AnketResultExport constructor.
     * @param mixed $anketId
     * @param mixed $anketResults
     * @param mixed $colQuantity
     */
    public function __construct($anketId, $anketResults, $colQuantity)
    {
        $this->anketResults = $anketResults;
        $this->anketId      = $anketId;
        $this->colQuantity  = $colQuantity;
    }

    /**
     * Csv data
     *
     * @return array
     */
    public function array() : array
    {
        $csvConfig    = config('consts.anketo.csv.' . $this->anketId);
        $this->header = $csvConfig['header'];

        switch ($this->anketId) {
            case 'anket_39':
                $cancerQaIndex    = $this->anket39_cancerQaIndex;
                $pregnancyQaIndex = $this->anket39_pregnancyQaIndex;
            break;
            case 'anket_26':
                $cancerQaIndex    = $this->anket26_cancerQaIndex;
                $pregnancyQaIndex = $this->anket26_pregnancyQaIndex;
            break;
        }

        // Add column for cancer question
        $qaCancerHeader      = $this->qaCancerHeader($cancerQaIndex);
        $qaCancerColQuantity = $this->colQuantity['qaCancer'] != 0 ? $this->colQuantity['qaCancer'] : 1;
        $this->insertHeader($qaCancerColQuantity, 'qaCancer', $qaCancerHeader);
        $this->replaceHeader('qaCancer');

        // Add column for pregnancy question
        $qaPregnancyColQuantity = $this->colQuantity['qaPregnancy'] != 0 ? $this->colQuantity['qaPregnancy'] : 1;
        for ($i = 1; $i < $qaPregnancyColQuantity + 1; $i++) {
            $qaPregnancyHeader = $this->qaPregnancyHeader($i, $pregnancyQaIndex);
            $this->insertHeader(1, 'qaPregnancy', $qaPregnancyHeader);
        }
        $this->replaceHeader('qaPregnancy');

        return [$this->header, $this->anketResults];
    }


    /**
     * Insert column into header
     *
     * @param mixed $quatity
     * @param mixed $name
     * @param mixed $insert
     * @return void
     */
    public function insertHeader($quatity, $name, $insert)
    {
        $header = $this->header;
        for ($i = 0; $i < $quatity; $i++) {
            $index = array_search($name, $header);
            array_splice($header, $index, 0, $insert);
        }

        $this->header = $header;
    }

    /**
     * Replace column in header
     *
     * @param mixed $name
     * @return void
     */
    public function replaceHeader($name)
    {
        $header = $this->header;
        $index  = array_search($name, $header);
        array_splice($header, $index, 1);

        $this->header = $header;
    }

    /**
     * Get pregnancy question header
     *
     * @param mixed $index
     * @param mixed $qaNum
     * @return array
     */
    public function qaPregnancyHeader($index, $qaNum)
    {
        return [
            $qaNum.'）' . $index . '回目妊娠(歳）',
            $qaNum.'）' . $index . '回目妊娠(年）',
            $qaNum.'）' . $index . '回目妊娠(月）',
            $qaNum.'）' . $index . '回目妊娠(日に）',
            $qaNum.'）' . $index . '回目妊娠(妊娠週）',
            $qaNum.'）' . $index . '回目妊娠(経過）',
            $qaNum.'）' . $index . '回目妊娠(医師より指摘：妊娠高血圧症候群 ）',
            $qaNum.'）' . $index . '回目妊娠(医師より指摘：子宮内胎児発育遅）',
            $qaNum.'）' . $index . '回目妊娠(医師より指摘：妊娠糖尿病）'
        ];
    }

    /**
     * Get cancer question header
     *
     * @param mixed $qaNum
     * @return array
     */
    public function qaCancerHeader($qaNum)
    {
        return [
            $qaNum.'）がんの種類',
            $qaNum.'）診断日-年',
            $qaNum.'）診断日-月',
            $qaNum.'）治療の状態',
            $qaNum.'）がんの治療',
            $qaNum.'）がんの治療(その他)',
        ];
    }
}
