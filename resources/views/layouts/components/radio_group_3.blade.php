<div class="row">
    @foreach($items as $value => $label)
    <div class="col-md-4">
        <label><input type="radio" name="{{$name}}" autocomplete="off" value="{{$value}}" data-error="#{{$name}}Error"> {{$label}}</label>
    </div>
    @endforeach
</div>
<div id="{{$name}}Error"></div>