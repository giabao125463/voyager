<br>
<label class="s-text">※双子の場合は、分けて記載してください。</label><br>
<label class="s-text">妊娠高血圧症候群：妊娠20週以降に高血圧やSLEによらないタンパク尿、腎障害を認めた場合に診断されます。</label><br>
<label class="s-text">子宮内胎児発育遅延：子宮内での赤ちゃんの発育が遅れ、妊娠週数と比較して赤ちゃんが基準を超えて小さい場合に診断されます。</label><br>
<label class="s-text">妊娠糖尿病：妊娠中に初めて診断された糖尿病のことをいいます。</label>
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">妊娠時年齢</th>
            <th class="text-center">妊娠経過</th>
        </tr>
    </thead>
    <tbody class="pregnancy-table">
        @for ($i = 0; $i < $rowCount; $i++)
        <tr class="auto-show auto-{{$i}}" data-id="{{$i}}">
            <td class="align-middle">
                {{$i + 1}}回目妊娠<br><input type="text" class="form-control fixed-w-80" placeholder="才" name="{{$qaName}}[{{$i}}][age]" id="{{$qaName}}_{{$i}}age">
            </td>
            <td>
                <div class="form-row">
                    <div class="col-md-3 pregnancy mb-1">
                        <div class="pregnancy-item">
                            <label>年</label>
                            <input type="text" class="form-control w-sp-60" placeholder="2009" name="{{$qaName}}[{{$i}}][year]" id="{{$qaName}}_{{$i}}year" data-error="#{{$qaName}}_{{$i}}yearError">
                        </div>
                        <div id="{{$qaName}}_{{$i}}yearError"></div>
                    </div>
                    <div class="col-md-3 pregnancy mb-1">
                        <div class="pregnancy-item">
                            <label>月</label>
                            <input type="text" class="form-control w-sp-60" placeholder="8" name="{{$qaName}}[{{$i}}][month]" id="{{$qaName}}_{{$i}}month" data-error="#{{$qaName}}_{{$i}}monthError">
                        </div>
                        <div id="{{$qaName}}_{{$i}}monthError"></div>
                    </div>
                    <div class="col-md-3 pregnancy mb-1">
                        <div class="pregnancy-item">
                            <label>日に</label>
                            <input type="text" class="form-control w-sp-60" placeholder="10" name="{{$qaName}}[{{$i}}][day]" id="{{$qaName}}_{{$i}}day" data-error="#{{$qaName}}_{{$i}}dayError">
                        </div>
                        <div id="{{$qaName}}_{{$i}}dayError"></div>
                    </div>
                    <div class="col-md-3 pregnancy mb-1">
                        <div class="pregnancy-item">
                            <label>妊娠週</label>
                            <input type="text" class="form-control w-sp-60" placeholder="35" name="{{$qaName}}[{{$i}}][pregnancyWeek]" id="{{$qaName}}_{{$i}}pregnancyWeek" data-error="#{{$qaName}}_{{$i}}pregnancyWeekError">
                        </div>
                        <div id="{{$qaName}}_{{$i}}pregnancyWeekError"></div>
                    </div>
                </div>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][pregnancyStatus]" value="1" data-error="#{{$qaName}}_{{$i}}pregnancyStatusError"> 現在妊娠中</label><br>
                <div id="{{$qaName}}_{{$i}}pregnancyStatusError"></div>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][pregnancyStatus]" value="2" data-error="#{{$qaName}}_{{$i}}pregnancyStatusError"> 早期流産（妊娠12週未満）</label>
                <div class="form-check">
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][miscarriageNatural]" value="1" disabled data-error="#{{$qaName}}_{{$i}}miscarriageNaturalError"> 自然流産</label><br>
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][miscarriageNatural]" value="0" disabled> 人工流産（人工中絶）</label><br>
                    <div id="{{$qaName}}_{{$i}}miscarriageNaturalError"></div>
                </div>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][pregnancyStatus]" value="3" data-error="#{{$qaName}}_{{$i}}pregnancyStatusError"> 後期流産（妊娠12週以降22週未満）</label><br>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][pregnancyStatus]" value="4" data-error="#{{$qaName}}_{{$i}}pregnancyStatusError"> 子宮内胎児死亡（妊娠22週以降）</label><br>
                <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][pregnancyStatus]" value="5" data-error="#{{$qaName}}_{{$i}}pregnancyStatusError"> 生児出産</label><br>
                <div class="form-check">
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][liveBirthPreterm]" value="1" disabled data-error="#{{$qaName}}_{{$i}}liveBirthPretermError"> 早産（妊娠22週以降37週未満）</label><br>
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="{{$qaName}}[{{$i}}][liveBirthPreterm]" value="0" disabled> 正期産（妊娠37週以降42週未満）</label>
                    <div id="{{$qaName}}_{{$i}}liveBirthPretermError"></div>
                </div>
                
                <div class="form-row">
                    ※妊娠中に産婦人科医師より指摘されたものをお答えください（複数回答可）
                </div>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="{{$qaName}}[{{$i}}][syndromeHypertension]" value="1"> 妊娠高血圧症候群</label>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="{{$qaName}}[{{$i}}][syndromeUteroRetardation]" value="1"> 子宮内胎児発育遅延</label>
                <label class="form-check-label"><input type="checkbox" class="form-check-input" name="{{$qaName}}[{{$i}}][syndromeGestationalDiabetes]" value="1"> 妊娠糖尿病</label>
            </td>
        </tr>
        @endfor
    </tbody>
</table>