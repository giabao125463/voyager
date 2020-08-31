@extends('layouts.front') @section('page_title', 'LUNA3患者アンケート登録時矢嶋修正') @section('head') @endsection @section('javascript') @endsection
@section('content')
@component('layouts.components.header', ['name' => '登録時用', 'anketId' => $anketId])@endcomponent
<form action="/anket/submit" method="POST" id="anketForm">
    @csrf
    <!--QA1-->
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>１）性別を教えてください。</label>
            <select class="form-control" name="gender" id="gender">
                <option value="">性別を選択してください</option>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
            </select>
        </div>
    </div>
    <!--QA2-->
    <div class="form-group">
        <label>２）生年月を教えてください。</label>
        <br>
        <div class="form-row">
            <div class="col-md-3">
                <label>年</label>
                <input type="text" class="form-control" name="qa2[year]" placeholder="1979">
            </div>
            <div class="col-md-3">
                <label>月</label>
                <input type="text" class="form-control" name="qa2[month]" placeholder="8">
            </div>
        </div>
        （例 １９７９年 ８月）※西暦わからないときは和暦（昭和、平成）でもかまいません。
    </div>
    <!--QA3-->
    <div class="form-group">
        <label>３）年齢を教えてください。</label>
        <br>
        <div class="form-row">
            <div class="col-md-3 form-inline">
                <label class="mr-1">満</label><input type="text" name="qa3" class="form-control" placeholder="39" maxlength="3"><label class="ml-1">歳</label>
            </div>
        </div>
    </div>
    <!--QA4-->
    <div class="form-group ">
        <label>４）現在の身長と体重を教えてください。（おおよその数値で結構です）</label>
        <br>
        <div class="form-row">
            <div class="col-md-3">
                <label>身長</label>
                <input type="text" name="qa4[height]" class="form-control" placeholder="ｃｍ" maxlength="3">
            </div>
            <div class="col-md-3">
                <label>体重</label>
                <input type="text" name="qa4[weight]" class="form-control" placeholder="ｋｇ" maxlength="3">
            </div>
        </div>
    </div>
    <!--QA5-->
    <div class="form-group">
        <label>５）あなたは、ビール・発泡酒、焼酎、日本酒、ワイン、ウィスキーなどのアルコール飲料をどのくらいの頻度で飲みますか。</label>
        <div class="row">
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="毎日"> <label></label><span>毎日</span></label>
            </div>
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="週に６回"> <label></label><span>週に６回</span></label>
            </div>
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="週に４〜５回"> <label></label><span>週に４〜５回</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="週に２〜３回"> <label></label><span>週に２〜３回</span></label>
            </div>
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="週に１回"> <label></label><span>週に１回</span></label>
            </div>
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="月に２〜３回"> <label></label><span>月に２〜３回</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="月に１回"> <label></label><span>月に１回 </span></label>
            </div>
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="月に１回より少ない"> <label></label><span>月に１回より少ない </span></label>
            </div>
            <div class="col-md-4">
                <label><input type="radio" name="qa5" data-error="#qa5Error" value="全く飲まない"> <label></label><span>全く飲まない</span></label>
            </div>
        </div>
        <div id="qa5Error"></div>
    </div>
    <!--QA6-->
    <div class="form-group">
        <label>６）飲むときは、どのぐらいのアルコール量を飲みますか。量を記載してください（複数回答可）。あてはまるお酒がない場合は、どれかに換算してお答えください。</label>
        <div class="row mb-1">
            <div class="col-md-8">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="qa6a[sel]" value="1" >
                    <span>ビール・発泡酒</span>
                    <span>（中びん１本 ５００ｍｌ）</span>
                    <span>（１缶 ３５０ｍｌ／５００ｍｌ）</span>
                </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="qa6a[ml]" placeholder="ｍｌ" onkeyup="autoCheck($(this), 'qa6a[sel]')" maxlength="4">
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-8 mb-1">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="qa6b[sel]" value="1" >
                    <span>日本酒（１合　１８０ｍｌ）</span>
                </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="qa6b[ml]" placeholder="ｍｌ" onkeyup="autoCheck($(this), 'qa6b[sel]')" maxlength="4">
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-8 mb-1">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="qa6c[sel]" value="1" >
                    <span> 焼酎（ストレート）</span>
                </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="qa6c[ml]" placeholder="ｍｌ" onkeyup="autoCheck($(this), 'qa6c[sel]')" maxlength="4">
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-8 mb-1">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="qa6d[sel]" value="1" >
                    <span>ウィスキー（ダブル１杯 ６０ｍｌ）</span>
                </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="qa6d[ml]" placeholder="ｍｌ" onkeyup="autoCheck($(this), 'qa6d[sel]')" maxlength="4">
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-8 mb-1">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="qa6e[sel]" value="1" >
                    <span>ワイン（グラス１杯　１００ｍｌ）</span>
                </label>
            </div>
            <div class="col-md-4">
                <input type="text" name="qa6e[ml]" class="form-control" placeholder="ｍｌ"onkeyup="autoCheck($(this), 'qa6e[sel]')" maxlength="4">
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-8 mb-1">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="qa6f[sel]" value="1" >
                    <span>缶酎ハイ（１缶 ３５０ｍｌ／５００ｍｌ）</span>
                </label>
            </div>
            <div class="col-md-4">
                <input type="text" name="qa6f[ml]" class="form-control" placeholder="ｍｌ" onkeyup="autoCheck($(this), 'qa6f[sel]')" maxlength="4">
            </div>
        </div>
    </div>
    <!--QA7-->
    <div class="form-group">
        <label>７）タバコは吸っていますか。<br>※電子タバコも含まれます。</label>
        <div class="row">
            <div class="col-md-3">
                <input type="radio" class="form-check-input" name="qa7" value="全く吸ったことがない" data-error="#qa7Error"><span> 全く吸ったことがない</span>
            </div>
            <div class="col-md-3">
                <input type="radio" class="form-check-input" name="qa7" value="今はやめて吸わない" data-error="#qa7Error"><span> 今はやめて吸わない</span>
            </div>
            <div class="col-md-3">
                <input type="radio" class="form-check-input" name="qa7" value="吸っている" data-error="#qa7Error"><span> 吸っている</span>
            </div>
        </div>
        <div id="qa7Error"></div>
    </div>
    <!--QA8-->
    <div class="form-group">
        <label>８）タバコを<span class="font-weight-bold"><u>「やめて吸わない」方</u></span>におうかがいします。吸っていた年齢と１日の本数をお こたえください。</label>
        <div class="form-row">
            <div class="col-md-4">
                <label>歳から</label>
                <input type="text" name="qa8[ageFrom]" class="form-control" placeholder="15" maxlength="3">
            </div>
            <div class="col-md-4">
                <label>歳まで</label>
                <input type="text" name="qa8[ageTo]" class="form-control" placeholder="30" maxlength="3">
            </div>
            <div class="col-md-4">
                <label>１日平均本</label>
                <input type="text" name="qa8[quantity]" class="form-control" placeholder="本" maxlength="3">
            </div>
        </div>
    </div>
    <!--QA9-->
    <div class="form-group">
        <label>９）タバコを<u><b>「吸っている」方</b></u>におうかがいします。吸い始めた年齢と１日の本数をおこた えください。
        </label>
        <div class="form-row">
            <div class="col-md-4">
                <label>歳から現在まで</label>
                <input type="text" name="qa9[age]" class="form-control" placeholder="20" maxlength="3">
            </div>
            <div class="col-md-4">
                <label>１日平均本</label>
                <input type="text" name="qa9[quantity]" class="form-control" placeholder="本" maxlength="3">
            </div>
        </div>
    </div>
    <!--QA10-->
    <div class="form-group">
        <label>１０）血の繋がったご家族（ご親戚）に膠原病の方はいますか。</label>
        <br>
        @component('layouts.components.yesno', ['name' => 'qa10'])@endcomponent
    </div>
    <!--QA11-->
    <div>
        <label>１１）<u><b>１０）で「はい」の方</u></b>はその病名もおこたえください。</label><br>
        <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
            <label class="btn btn-secondary">
                <input type="checkbox" class="no-icheck" name="qa11" autocomplete="off" value="SLE" data-error="#qa11Error" onchange="changeButtonGroup($(this), '#qa11Error');changeToogle($(this));"> SLE
            </label>
            <label class="btn btn-secondary">
                <input type="checkbox" class="no-icheck" name="qa11" autocomplete="off" value="その他" data-error="#qa11Error" onchange="changeButtonGroup($(this), '#qa11Error');changeToogle($(this));"> その他
            </label>
        </div>
        <div id="qa11Error"></div>
        <div class="form-row">
            <input type="text" class="form-control col-md-8" placeholder="（自由記載）：" name="qa11Other" style="display:none" data-error="#qa11ErrorOther" id="qa11Other">
        </div>
        <div id="qa11ErrorOther"></div>
    </div>
    <!--QA12-->
    <div class="form-group">
        <label>１２）これまでに日光過敏の症状はありますか。（日光過敏とは「日光に当たった皮膚がすぐに赤くなったり水ぶくれができたり、熱が出た りすること」です。）</label><br>
        @component('layouts.components.yesno', ['name' => 'qa12'])@endcomponent
    </div>
    <!--QA13-->
    <div class="form-group">
        @component('layouts.components.drugs', ['qaNumber' => '１３'])@endcomponent
    </div>
    <!--QA14-->
    <div class="form-group">
        <label>１４）子宮頸がんワクチン」をうけたことはありますか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa14'])@endcomponent
    </div>
    <!--QA15-->
    <div class="form-group">
        <label>１５）「肺炎球菌ワクチン」をうけたことはありますか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa15'])@endcomponent
    </div>
    <!--QA16-->
    <div class="form-group">
        <label>１６）「帯状疱疹ワクチン」をうけたことはありますか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa16'])@endcomponent
    </div>
    <!--QA17-->
    <div class="form-group">
        <label>１７）この１年間で「インフルエンザワクチン」をうけましたか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa17'])@endcomponent
    </div>
    <!--QA18-->
    <div class="form-group">
        <label>１８）がんと診断されたことはありますか。（子宮がんの場合は異形成（いけいせい）も含みます。）</label><br>
        @component('layouts.components.yesno', ['name' => 'qa18'])@endcomponent
    </div>
    <!-- QA19 -->
    <div class="form-group">
        <label>１９）<b><u>１８）で「はい」とこたえた方</u></b>はその詳細をおこたえください。</label>
        @component('layouts.components.cancer', ['rowCount' => 4, 'qaName' => 'qa19'])@endcomponent
    </div>
    <!--QA20-->
    <div class="form-group">
        <label>２０）以下の中で<u>「あなたが<span class="font-weight-bold">SLEと診断された以降に、</span></u>診断された病気・受けた治療」が あれば、チェック（✔）をご記入ください。（複数回答可）</label><br>
        @component('layouts.components.diseases',['qaName' => 'qa20'])@endcomponent
    </div>
    <!--QA21-->
    <div class="form-group">
        <label>２１）以下の中で「これまでに入院して治療した感染症」があれば、チェック（✔）をし、年齢を記載してください。（複数回答可）</label><br>
        <div class="mb-2">
            <input type="checkbox" class="form-check-input" name="diagnosedInfection" data-error="#diagnosedInfectionError" value="1">
            <label class="form-check-label">特になし</label><br>
            <div id="diagnosedInfectionError"></div>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="align-middle">
                        <label><input type="checkbox" class="form-check-input" name="infectionPneumonia" value="1"> 肺炎</label>
                    </td>
                    <td>
                        <input type="text" name="infectionPneumoniaAge" class="form-control" placeholder="歳" onkeyup="autoCheck($(this), 'infectionPneumonia')" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">
                        <label><input type="checkbox" class="form-check-input" value="1" name="infectionSepsis"> 敗血症</label>
                    </td>
                    <td>
                        <input type="text" name="infectionSepsisAge" class="form-control" placeholder="歳" onkeyup="autoCheck($(this), 'infectionSepsis')" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">
                        <label><input type="checkbox" class="form-check-input" value="1" name="infectionArthritis"> 感染性関節炎</label>
                    </td>
                    <td>
                        <input type="text" name="infectionArthritisAge" class="form-control" placeholder="歳" onkeyup="autoCheck($(this), 'infectionArthritis')" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">
                        <label><input type="checkbox" class="form-check-input" value="1" name="infectionPyelonephritis"> 腎盂腎炎</label>
                    </td>
                    <td>
                        <input type="text" name="infectionPyelonephritisAge" class="form-control" placeholder="歳" onkeyup="autoCheck($(this), 'infectionPyelonephritis')" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">
                        <label><input type="checkbox" class="form-check-input" value="1" name="infectionOsteomyelitis"> 骨髄炎</label>
                    </td>
                    <td>
                        <input type="text" name="infectionOsteomyelitisAge" class="form-control" placeholder="歳" onkeyup="autoCheck($(this), 'infectionOsteomyelitis')" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">
                        <label><input type="checkbox" class="form-check-input" value="1" name="infectionHerpesZoster"> 帯状疱疹</label><br>
                        <label><input type="checkbox" class="form-check-input" value="1" name="infectionCellulitis"> 蜂窩織炎</label>
                    </td>
                    <td>
                        <input type="text" name="infectionHerpesZosterAge" class="form-control" placeholder="歳" onkeyup="autoCheck($(this), 'infectionHerpesZoster')" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">
                        <label><input type="checkbox" class="form-check-input" value="1" name="infectionPeritonitis"> 腹膜炎</label>
                    </td>
                    <td>
                        <input type="text" name="infectionPeritonitisAge" class="form-control" placeholder="歳" onkeyup="autoCheck($(this), 'infectionPeritonitis')" maxlength="3">
                    </td>
                </tr>
                <tr>
                    <td class="border-0">その他の感染症（あれば具体的に記載してください）</td>
                    <td class="border-0"></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="infectionOther1Name" class="form-control mb-1" placeholder="（自由記載）：" maxlength="200">
                        <input type="text" name="infectionOther2Name" class="form-control mb-1" placeholder="（自由記載）：" maxlength="200">
                        <input type="text" name="infectionOther3Name" class="form-control" placeholder="（自由記載）：" maxlength="200">
                    </td>
                    <td>
                        <input name="infectionOther1Age" type="text" class="form-control mb-1" placeholder="歳" maxlength="3">
                        <input name="infectionOther2Age" type="text" class="form-control mb-1" placeholder="歳" maxlength="3">
                        <input name="infectionOther3Age" type="text" class="form-control mb-1" placeholder="歳" maxlength="3">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--QA22-->
    <div class="form-group">
        <div><b>２２）〜２５）は女性の方のみおこたえください。（男性の方は、２６）以降をおこたえください。</b></div>
    </div>
    <div class="form-group">
        <label>２２）卵巣機能不全（無月経）と診断されたことがありますか？</label><br>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary" id="ovarianDiagnosedN">
                <input type="checkbox" class="no-icheck" name="qa22[ovarianDiagnosed]" autocomplete="off" value="いいえ" data-error="#qa22_ovarianDiagnosed-error" onchange="hideError('#qa22_ovarianDiagnosed-error');uncheckChildren($(this));changeToogle($(this))"> いいえ
            </label>
            <label class="btn btn-secondary" id="ovarianDiagnosedY">
                <input type="checkbox" class="no-icheck" name="qa22[ovarianDiagnosed]" autocomplete="off" value="はい" data-error="#qa22_ovarianDiagnosed-error" onchange="hideError('#qa22_ovarianDiagnosed-error');changeToogle($(this))"> はい
            </label>
        </div>
        <div><div id="qa22_ovarianDiagnosed-error"></div></div>
        <label class="form-check-label">（<input type="radio" class="form-check-input" name="qa22[ageAbove40]" value="0" data-error="#qa22_ageAbove40-error"> 40歳未満、</label>
        <label class="form-check-label"><input type="radio" class="form-check-input" name="qa22[ageAbove40]" value="1" data-error="#qa22_ageAbove40-error"> 40歳以上）チェックをつけてください。</label>
        <div id="qa22_ageAbove40-error"></div>
    </div>
    <!-- QA23 -->
    <div class="form-group">
        <label>２３）今までに妊娠のご経験はありますか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa23'])@endcomponent
    </div>
    <!-- QA24 -->
    <div class="form-group">
        <label>２４）<u><b>２３）で「はい」の方</u></b>は、妊娠回数は何回ですか（流産も含めおこたえください）。</label><br>
        <input type="text" class="form-control" placeholder="回" name="qa24">
    </div>
    <!-- QA25 -->
    <div class="form-group">
        <label>２５）<u><b>２３）で「はい」の方</b></u>は、<u><b>これまでの</b></u>妊娠について妊娠時年齢、妊娠経過について記入をお願いします。</label>
        @component('layouts.components.prenancy', ['rowCount' => 5, 'qaName' => 'qa25'])@endcomponent
    </div>
     <!--QA26-->
     <div class="form-group">
        <label>２６）学校教育はどこまで卒業されましたか。</label>
        <div class="flex-col">
            <label><input type="radio" class="form-check-input" name="qa26" value="小学校または中学校卒" data-error="#qa26Error"> 小学校または中学校卒　</label>
            <label><input type="radio" class="form-check-input" name="qa26" value="高校、専門学校、高等専門学校、短大卒" data-error="#qa26Error"> 高校、専門学校、高等専門学校、短大卒　</label>
            <label><input type="radio" class="form-check-input" name="qa26" value="大学または大学院卒" data-error="#qa26Error"> 大学または大学院卒　</label>
            <label><input type="radio" class="form-check-input" name="qa26" value="その他" data-error="#qa26Error"> その他</label>
        </div>
        <div id="qa26Error"></div>
        <input type="text" class="form-control" name="qa26Other" placeholder="（自由記載）：" style="display:none;" id="qa26Other">
    </div>
    <!--QA27-->
    <div class="form-group">
        <label>２７）<span class="font-weight-bold text-under-line">現在</span>、あなたと生計を共にしている世帯人数は、<u><b>あなたを含めて</b></u>何人ですか。生計を共にしている世帯人数（あなたを含めて）</label>
        <input type="text" class="form-control" placeholder="人" name="qa27">
    </div>
    <!--QA28-->
    <div class="form-group">
        <label>２８）２７）で答えた<span class="font-weight-bold text-under-line">世帯全体</span>の合計収入額（年金を含みます）は、次のうちどれにあてはまりますか（税引き前）。</label>
        <div class="row">
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="50 万円未満" data-error="#qa28Error"> 50万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="50～100万円未満" data-error="#qa28Error"> 50～100万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="100～150万円未満" data-error="#qa28Error"> 100～150万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="150～200万円未満" data-error="#qa28Error"> 150～200万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="200～250万円未満" data-error="#qa28Error"> 200～250万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="250～300万円未満" data-error="#qa28Error"> 250～300万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="300～400万円未満" data-error="#qa28Error"> 300～400万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="400～500万円未満" data-error="#qa28Error"> 400～500万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="500～600万円未満" data-error="#qa28Error"> 500～600万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="600～700万円未満" data-error="#qa28Error"> 600～700万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="700～800万円未満" data-error="#qa28Error"> 700～800万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="800～900万円未満" data-error="#qa28Error"> 800～900万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="900～1,000万円未満" data-error="#qa28Error"> 900～1,000万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="1,000～1,200万円未満" data-error="#qa28Error"> 1,000～1,200万円未満</label></div>
            <div class="col-md-4"><label><input type="radio" class="form-check-input" name="qa28" value="1,200万円以上" data-error="#qa28Error"> 1,200万円以上</label></div>
        </div>
        <div id="qa28Error"></div>
    </div>
    <!-- QA29 -->
    <div class="form-group">
        <label>２９）<u><b>現在、</b></u>あなたの婚姻状態についておうかがいします。</label><br>
        @component('layouts.components.radio_group', [
            'name' => 'qa29',
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
    <!--QA30-->
    <div class="form-group">
        <label>３０）現在、あなたはご家族の介護をされていますか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa30'])@endcomponent
    </div>
    <!--QA31-->
    <div class="form-group">
        <label>３１）現在、あなたは育児をされていますか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa31'])@endcomponent
    </div>
    <!--QA32-->
    <div class="form-group">
        <label>３２）現在、SLE<span class="text-under-line font-weight-bold">を発症してから10年以内</span>ですか。</label><br>
        @component('layouts.components.yesno', ['name' => 'qa32'])@endcomponent
    </div>
    <!-- QA33 -->
    <div class="form-group">
        <label>３３）<u><b>３２）で「はい」の方</b></u>は、お答えください。</label><br>
        <label>SLEを発症してからこれまでに外来で何人の主治医があなたを担当しましたか？</label><br>
        <label>※当院より前の医療機関の医師もふくめてください。</label><br>
        <label>※わからない方はおよその人数でかまいません。「2人以上」「1〜4人」などはさけてください。</label>
        <input type="text" class="form-control" placeholder="人" name="qa33" maxlength="3">
    </div>
    <!-- QA34 -->
    <div class="form-group">
        <label>３４）<u><b>３２）で「はい」の方</b></u>は、お答えください。</label><br>
        <label>SLEを発症してからこれまでにSLEに関連した入院は何回ありましたか？</label><br>
        <label>※当院より前の医療機関での入院もふくめてください。</label><br>
        <label>※検査目的の入院は除いてください。</label><br>
        <label>※わからない方はおよその回数でかまいません。 「2回以上」「1〜4回」などは、さけてください。</label>
        <input type="text" class="form-control" placeholder="回" name="qa34" maxlength="3">
    </div>
    <!--QA35-->
    <div class="form-group">
        <label>３５）この疾患（SLE）を担当する主治医氏名を(できれば)フルネームで記入してください。</label>
        <input type="text" class="form-control" placeholder="（自由記載）：" maxlength="200" name="qa35">
    </div>
    <!--QA36-->
    <div class="form-group">
        <label>３６）主治医が３カ月以内に変更になりましたか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa36'])@endcomponent
    </div>
    <!--QA37-->
    <div class="form-group">
        <label>３７） <span class="text-dark font-weight-bold text-under-line">３６）で「はい」の方は</span>、お答えください。主治医の性別は変わりましたか？</label><br>
        @component('layouts.components.yesno', ['name' => 'qa37'])@endcomponent
    </div>
    <!--QA38-->
    <div class="form-group">
        <label>３８）この病院を0点から10点で評価してください。（０点は考えられる範囲内で最低、１０点は考えられる範囲内で最高を示します）</label><br>
        <div class="d-none d-md-block">
            @component('layouts.components.button_group', [
                'name' => 'qa38',
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
            <div id="qa38ErrorPc"></div>
        </div>
        <div class="d-block d-md-none btn-toolbar">
            <div class="mb-1">
                @component('layouts.components.button_group', [
                    'name' => 'qa38',
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
                    'name' => 'qa38',
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
            <div id="qa38ErrorSp"></div>
        </div>
    </div>
    <!--QA39-->
    <div class="form-group">
        <label>３９）あなたは当病院で受けた医師の診察についてどのような印象をお持ちですか。次の項目ごとに、「非常によくあてはまる」から「全くあてはまらない」までの5段階のなかから、もっともよくあてはまると思うものを１つ選んでください。</label><br>
        @component('layouts.components.understanding')@endcomponent
    </div>
    @component('layouts.components.anket_lupus')@endcomponent
    @component('layouts.components.anket_sf12', ['anketDescription' => $anketDescription])@endcomponent
    @component('layouts.components.footer_common', ['editMode' => $editMode, 'historyId' => $historyId])@endcomponent
</form>
@endsection
@include('frontend.anket.anket_39_script')
@component('layouts.components.common')@endcomponent
