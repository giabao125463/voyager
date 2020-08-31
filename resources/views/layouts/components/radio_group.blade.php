<div>
    @foreach($items as $value => $label)
    <label><input type="radio" name="{{$name}}" autocomplete="off" value="{{$value}}" data-error="#{{$name}}Error"> {{$label}}</label>
    @endforeach
    <div id="{{$name}}Error"></div>
</div>