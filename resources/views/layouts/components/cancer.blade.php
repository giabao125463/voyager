@for ($i = 0; $i < $rowCount; $i++)
<div class="form-group card-show card-{{$i}}" data-id="{{$i}}">
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>がんの種類</label>
                <input type="text" maxlength="100" class="form-control" placeholder="乳" name="{{$qaName}}[{{$i}}][typeOfCancer]" id="{{$qaName}}_{{$i}}typeOfCancer">
                </div>
                <div class="form-group col-md-3">
                    <label>診断日－年</label>
                    <input type="text" class="form-control" placeholder="2015" name="{{$qaName}}[{{$i}}][diagnosisYear]" id="{{$qaName}}_{{$i}}diagnosisYear">
                </div>
                <div class="form-group col-md-3">
                    <label>診断日－月</label>
                    <input type="text" class="form-control" placeholder="12" name="{{$qaName}}[{{$i}}][diagnosisMonth]" id="{{$qaName}}_{{$i}}diagnosisMonth">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label>治療の状態</label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary">
                            <input type="checkbox" class="no-icheck" name="{{$qaName}}[{{$i}}][stateTreatment]" autocomplete="off" value="治療すみ" data-error="#{{$qaName}}_{{$i}}stateTreatment-error" onchange="changeCancerGroup($(this));changeToogle($(this))"> 治療すみ
                        </label>
                        <label class="btn btn-secondary">
                            <input type="checkbox" class="no-icheck" name="{{$qaName}}[{{$i}}][stateTreatment]" autocomplete="off" value="現在治療中" data-error="#{{$qaName}}_{{$i}}stateTreatment-error" onchange="changeCancerGroup($(this));changeToogle($(this))"> 現在治療中
                        </label>
                        <label class="btn btn-secondary">
                            <input type="checkbox" class="no-icheck" name="{{$qaName}}[{{$i}}][stateTreatment]" autocomplete="off" value="経過観察中" data-error="#{{$qaName}}_{{$i}}stateTreatment-error" onchange="changeCancerGroup($(this));changeToogle($(this))"> 経過観察中
                        </label>
                    </div>
                    <div id="{{$qaName}}_{{$i}}stateTreatment-error"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label>がんの治療</label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary">
                            <input type="checkbox" class="no-icheck" name="{{$qaName}}[{{$i}}][cancerTreatment][val1]" autocomplete="off" value="抗がん剤" data-error="#{{$qaName}}_{{$i}}cancerTreatment-error"> 抗がん剤
                        </label>
                        <label class="btn btn-secondary">
                            <input type="checkbox" class="no-icheck" name="{{$qaName}}[{{$i}}][cancerTreatment][val2]" autocomplete="off" value="手術" data-error="#{{$qaName}}_{{$i}}cancerTreatment-error"> 手術
                        </label>
                        <label class="btn btn-secondary">
                            <input type="checkbox" class="no-icheck" name="{{$qaName}}[{{$i}}][cancerTreatment][val3]" autocomplete="off" value="放射線" data-error="#{{$qaName}}_{{$i}}cancerTreatment-error"> 放射線
                        </label>
                        <label class="btn btn-secondary">
                            <input type="checkbox" class="no-icheck" name="{{$qaName}}[{{$i}}][cancerTreatment][val4]" autocomplete="off" value="その他" data-error="#{{$qaName}}_{{$i}}cancerTreatment-error" onchange="changeCancerGroupCheckbox($(this), '#{{$qaName}}_{{$i}}cancerTreatmentOtherText')"> その他
                        </label>
                    </div>
                    <div id="{{$qaName}}_{{$i}}cancerTreatment-error"></div>
                </div>
            </div>
            <div class="form-row">
                <input type="text" maxlength="100" class="form-control" placeholder="ホルモン療法" name="{{$qaName}}[{{$i}}][cancerTreatmentOther]" style="display: none" data-error="#{{$qaName}}_{{$i}}cancerTreatmentOther-error" id="{{$qaName}}_{{$i}}cancerTreatmentOtherText">
                <div id="{{$qaName}}_{{$i}}cancerTreatmentOther-error"></div>
            </div>
        </div>
    </div>
</div>
@endfor
