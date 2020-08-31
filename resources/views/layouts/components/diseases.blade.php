<div class="mb-2">
    <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diagnosedDiseases" value="1" data-error="#diagnosedDiseasesError"> 特になし</label><br>
    <div id="diagnosedDiseasesError"></div>
</div>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>目の病気</td>
            <td>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseEyeCataract" value="1"> 白内障</label><br>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseEyeVisualLoss" value="1"> 網膜変性・視神経萎縮などによる視力低下</label>
            </td>
        </tr>
        <tr>
            <td>脳の病気</td>
            <td>
                <div class="form-check form-check-inline">
                    脳梗塞（<label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseCerebralInfarction" value="1"> 1回、</label>
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseCerebralInfarction" value="2"> 2回以上）</label>
                </div><br>
                <div class="form-check form-check-inline">
                    脳出血（<label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseCerebralHemorrhage" value="1"> 1回、</label>
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseCerebralHemorrhage" value="2"> 2回以上）</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>腎臓の病気</td>
            <td>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseKidneyDialysis" value="1"> 人工透析</label><br>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseKidneyTransplant" value="1"> 腎移植</label>
            </td>
        </tr>
        <tr>
            <td>心臓の病気</td>
            <td>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseHeartAngina" value="1"> 狭心症</label><br>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseHeartCoronarySurgery" value="1"> 冠動脈バイパス術</label><br>
                <div class="form-check form-check-inline">
                    心筋梗塞（<label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseHeartInfarction" value="1"> 1回、</label>
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseHeartInfarction" value="2"> 2回以上）</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>末梢血管の病気</td>
            <td>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseVascularLameness" value="1"> 6ヶ月以上続く跛行（足を引きずるような歩行、しばらく歩いていると歩けなくなる）</label><br>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseVascularTissueLoss" value="1"> 指先の小さな組織欠損、指や手足の欠損（</label>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseVascularTissueLossLocation" value="1"> 1箇所、</label>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseVascularTissueLossLocation" value="2"> 2箇所以上）</label>
            </td>
        </tr>
        <tr>
            <td>消化管の病気</td>
            <td>
                腸管・脾、肝、胆のうの梗塞または切除手術（<label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseDigestResection" value="1"> 1回、</label>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseDigestResection" value="2"> 2回以上）</label><br>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseDigestStomach" value="1"> 食道・胃の狭窄または切除手術</label>
            </td>
        </tr>
        <tr>
            <td>筋肉や骨の病気</td>
            <td>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseBoneOsteoporosis" value="1"> 骨折や椎骨（せぼね）の変形を伴う骨粗しょう症</label><br>
                骨頭壊死（えし）（<label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseBoneNecrosis" value="1"> 1回、</label>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseBoneNecrosis" value="2"> 2回以上）</label>
            </td>
        </tr>
        <tr>
            <td>皮膚の病気</td>
            <td>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseSkinUlcer" value="1"> 6か月以上続く皮膚潰瘍</label>
            </td>
        </tr>
        <tr>
            <td>その他</td>
            <td>
                
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="diseaseOthersDiabetes" value="1"> 糖尿病（6ヶ月以上続く）</label><br>
                悪性腫瘍（がん）（<label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseOthersTumor" value="1"> 1回、</label>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="diseaseOthersTumor" value="2"> 2回以上）</label>
            </td>
        </tr>
    </tbody>
</table>