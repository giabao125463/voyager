<div class="btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-secondary">
        <input type="checkbox" class="no-icheck" name="{{$name}}" autocomplete="off" value="いいえ" data-error="#{{$name}}-error" onchange="hideError('#{{$name}}-error');changeToogle($(this))"> いいえ
    </label>
    <label class="btn btn-secondary">
        <input type="checkbox" class="no-icheck" name="{{$name}}" autocomplete="off" value="はい" data-error="#{{$name}}-error" onchange="hideError('#{{$name}}-error');changeToogle($(this))"> はい
    </label>
</div>
<div id="{{$name}}-error"></div>