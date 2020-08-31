
<div class="btn-group btn-group-toggle">
    @foreach($items as $value => $label)
    <label class="btn btn-secondary">
        <input type="radio" class="no-icheck" name="{{$name}}" autocomplete="off" value="{{$value}}" data-error="#{{$name}}Error{{$type}}"> {{$label}}
    </label>
    @endforeach
</div>