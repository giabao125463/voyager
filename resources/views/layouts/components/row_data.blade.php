@for ($i = 0; $i < $rows; $i++)
<tr>
    @foreach ($items as $item)
    <td>{{$i + 1}}</td>
    <td>{{$item['title']}}</td>
    <td class="text-md-center align-middle">
        <input type="radio" class="form-check-input" name="{{$name}}[{{$i}}][val]" value="5" data-error="#understand_{{$i}}Error">
        <span class="d-md-none d-inline"> たいへんよくあてはまる</span>'+'</td>'
    @endforeach
</tr>
@endfor
