@extends('layouts.front')

@section('page_title', 'LUNA3患者アンケート追跡時')

@section('head')
@endsection

@section('content')
@component('layouts.components.header', ['name' => '追跡時用', 'anketId' => $anketId])@endcomponent
<form action="/anket/submit" method="POST" id="anketForm">
    @csrf
    <!-- QA1 -->
    <div class="form-group">
        @component('layouts.components.drugs', ['qaNumber' => '１'])@endcomponent
    </div>
    <!-- QA2 -->
    <div class="form-group">
        <label>２）<b><u>この１年間で</u></b>「子宮頸がんワクチン」をうけましたか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa2'])@endcomponent
    </div>
    <!-- QA3 -->
    <div class="form-group">
        <label>３）<b><u>この１年間で</u></b>「肺炎球菌ワクチン」をうけましたか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa3'])@endcomponent
    </div>
    <!-- QA4 -->
    <div class="form-group">
        <label>４）<b><u>この１年間で</u></b>「帯状疱疹ワクチン」をうけましたか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa4'])@endcomponent
    </div>
    <!-- QA5 -->
    <div class="form-group">
        <label>５）<b><u>この１年間で</u></b>「インフルエンザワクチン」をうけましたか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa5'])@endcomponent
    </div>
    <!-- QA6 -->
    <div class="form-group">
        <label>６）<b><u>この１年間で</u></b>がんと診断されましたか。（子宮がんの場合は異形成（いけいせい）も含みます。）</label><br>
        @component('layouts.components.yesno', ['name' => 'qa6'])@endcomponent
    </div>
    <!-- QA7 -->
    <div class="form-group">
        <label>７）<b><u>６）で「はい」とこたえた方</u></b>はその詳細をおこたえください。</label>
        @component('layouts.components.cancer', ['rowCount' => 3, 'qaName' => 'qa7'])@endcomponent
    </div>
    <!-- QA8 -->
    <div class="form-group">
        <label>８）以下の中で<u>「あなたが<b>SLEと診断された以降に、</b></u>診断された病気・受けた治療」があれば、チェック（✔︎）をご記入ください。（複数回答可）</label>
        @component('layouts.components.diseases', ['qaName' => 'qa8'])@endcomponent
    </div>
    <!-- QA9 -->
    <div class="form-group">
        <label>９）過去３か月の間に、頭痛で困ったことはありますか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa9'])@endcomponent
    </div>
    <!-- QA10 -->
    <div class="form-group">
        <label>１０）<u><b>９）で「はい」と答えた方</b></u>は、お答えください。<br>
            過去3か月にあったすべての頭痛について、以下の質問に答えてください。<br>
            それぞれの質問の右側の欄に答えを記入してください。<br>
            該当する出来事がなければ、“０”と記入してください。
        </label>
        @component('layouts.components.headache')@endcomponent
    </div>
    <!-- QA11 -->
    <div class="form-group">
        <div><b>１１）〜１４）は女性の方のみおこたえください。（男性の方は、１5）以降をおこたえください。</b></div>
    </div>
    <div class="form-group">
        <label>１１）<u><b>この1年間で、</b></u>卵巣機能不全（無月経）と診断されましたか。</label><br>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary" id="ovarianDiagnosedN">
                <input type="checkbox" class="no-icheck" name="qa11[ovarianDiagnosed]" autocomplete="off" value="いいえ" data-error="#qa11_ovarianDiagnosed-error" onchange="hideError('#qa11_ovarianDiagnosed-error');uncheckChildren($(this));changeToogle($(this))"> いいえ
            </label>
            <label class="btn btn-secondary" id="ovarianDiagnosedN">
                <input type="checkbox" class="no-icheck" name="qa11[ovarianDiagnosed]" autocomplete="off" value="はい" data-error="#qa11_ovarianDiagnosed-error" onchange="hideError('#qa11_ovarianDiagnosed-error');uncheckChildren($(this));changeToogle($(this))"> はい
            </label>
        </div>
        <div><div id="qa11_ovarianDiagnosed-error"></div></div>
        <label class="form-check-label">（<input type="radio" class="form-check-input" name="qa11[ageAbove40]" value="0" data-error="#qa11_ageAbove40-error"> 40歳未満、</label>
        <label class="form-check-label"><input type="radio" class="form-check-input" name="qa11[ageAbove40]" value="1" data-error="#qa11_ageAbove40-error"> 40歳以上）チェックをつけてください。</label>
        <div id="qa11_ageAbove40-error"></div>
    </div>
    <!-- QA12 -->
    <div class="form-group">
        <label>１２）<b><u>この１年間で、</u></b>妊娠されましたか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa12'])@endcomponent
    </div>
    <!-- QA13 -->
    <div class="form-group">
        <label>１３）<u><b>１２）で「はい」の方</b></u>は、<u><b>この1年間で</b></u>妊娠回数は何回ですか（流産も含めおこたえください）。</label>
        <input type="text" class="form-control" placeholder="回" name="qa13">
    </div>
    <!-- QA14 -->
    <div class="form-group">
        <label>１４）<u><b>１２）で「はい」の方</b></u>は、<u><b>この1年間での</b></u>妊娠について妊娠時年齢、妊娠経過について記入をお願いいたします。</label>
        @component('layouts.components.prenancy', ['rowCount' => 3, 'qaName' => 'qa14'])@endcomponent
    </div>
    <!-- QA15 -->
    <div class="form-group">
        <label>１５）<u><b>現在、</b></u>あなたと生計を共にしている世帯人数は、<u><b>あなたを含めて</b></u>何人ですか。生計を共にしている世帯人数（あなたを含めて）</label>
        <input type="text" class="form-control" placeholder="人" name="qa15">
    </div>
    <!-- QA16 -->
    <div class="form-group">
        <label>１６）<u><b>現在、</b></u>あなたの婚姻状態についておうかがいします。</label><br>
        @component('layouts.components.radio_group', [
            'name' => 'qa16',
            'items' => [
                '配偶者がいる（結婚・再婚・内縁）' => '配偶者がいる（結婚・再婚・内縁）',
                '別居' => '別居',
                '離婚' => '離婚',
                '死別' => '死別',
                '未婚' => '未婚'
            ]
        ])
        @endcomponent
    </div>
    <!-- QA17 -->
    <div class="form-group">
        <label>１７）<u><b>現在、</b></u>あなたはご家族の介護をされていますか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa17'])@endcomponent
    </div>
    <!-- QA18 -->
    <div class="form-group">
        <label>１８）<u><b>現在、</b></u>あなたは育児をされていますか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa18'])@endcomponent

    </div>
    <!-- QA19 -->
    <div class="form-group">
        <label>１９）この疾患（SLE）を担当する現在の主治医氏名をフルネームで記入してください。</label><br>
        <input type="text" class="form-control" placeholder="梶山" name="qa19" maxlength="100">
    </div>
    <!-- QA20 -->
    <div class="form-group">
        <label>２０） 現在、SLEを<u><b>発症してから10年以内</b></u>ですか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa20'])@endcomponent

    </div>
    <!-- QA21 -->
    <div class="form-group">
        <label>２１）<u><b>２０）で「はい」の方</b></u>は、お答えください。</label><br>
        <label>SLEを発症してからこれまでに外来で何人の主治医があなたを担当しましたか？</label><br>
        <label>※当院より前の医療機関の医師もふくめてください。</label><br>
        <label>※わからない方はおよその人数でかまいません。「2人以上」「1〜4人」などはさけてください。</label>
        <input type="text" class="form-control" placeholder="人" name="qa21">
    </div>
    <!-- QA22 -->
    <div class="form-group">
        <label>２２）<u><b>２０）で「はい」の方</b></u>は、お答えください。</label><br>
        <label>SLEを発症してからこれまでにSLEに関連した入院は何回ありましたか？</label><br>
        <label>※当院より前の医療機関での入院もふくめてください。</label><br>
        <label>※検査目的の入院は除いてください。</label><br>
        <label>※わからない方はおよその回数でかまいません。 「2回以上」「1〜4回」などは、さけてください。</label>
        <input type="text" class="form-control" placeholder="回" name="qa22">
    </div>
    <!-- QA23 -->
    <div class="form-group">
        <label>２３）主治医が３カ月以内に変更になりましたか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa23'])@endcomponent

    </div>
    <!-- QA24 -->
    <div class="form-group">
        <label>２４）<u><b>２３）で「はい」の方</b></u>は、お答えください。主治医の性別は変わりましたか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa24'])@endcomponent

    </div>
    <!-- QA25 -->
    <div class="form-group">
        <label>２５）この病院を0点から10点で評価してください。（０点は考えられる範囲内で最低、１０点は考えられる範囲内で最高を示します）</label><br>
        <div class="d-none d-md-block">
            @component('layouts.components.button_group', [
                'name' => 'qa25',
                'type' => 'Pc',
                'items' => [
                    '０' => '０',
                    '１' => '１',
                    '２' => '２',
                    '３' => '３',
                    '４' => '４',
                    '５' => '５',
                    '６' => '６',
                    '７' => '７',
                    '８' => '８',
                    '９' => '９',
                    '１０' => '１０',
                ]
            ])
            @endcomponent
            <div id="qa25ErrorPc"></div>
        </div>
        <div class="d-block d-md-none btn-toolbar">
            <div class="mb-1">
                @component('layouts.components.button_group', [
                    'name' => 'qa25',
                    'type' => 'Sp',
                    'items' => [
                        '０' => '０',
                        '１' => '１',
                        '２' => '２',
                        '３' => '３',
                        '４' => '４',

                    ]
                ])
                @endcomponent
            </div>
            <div>
                @component('layouts.components.button_group', [
                    'name' => 'qa25',
                    'type' => 'Sp',
                    'items' => [
                        '５' => '５',
                        '６' => '６',
                        '７' => '７',
                        '８' => '８',
                        '９' => '９',
                        '１０' => '１０',
                    ]
                ])
                @endcomponent
            </div>
            <div id="qa25ErrorSp"></div>
        </div>
    </div>
    <!-- QA26 -->
    <div class="form-group">
        <label>２６）あなたは当病院で受けた医師の診察についてどのような印象をお持ちですか。次の項目ごとに、「非常によくあてはまる」から「全くあてはまらない」までの5段階のなかから、もっともよくあてはまると思うものを１つ選んでください。</label><br>
        @component('layouts.components.understanding')@endcomponent
    </div>
    @component('layouts.components.anket_lupus')@endcomponent
    @component('layouts.components.anket_sf12', ['anketDescription' => $anketDescription])@endcomponent
    @component('layouts.components.footer_common', ['editMode' => $editMode, 'historyId' => $historyId])@endcomponent
</form>
@endsection
@include('frontend.anket.anket_26_script')
@component('layouts.components.common', ['name' => 'qa26'])@endcomponent
