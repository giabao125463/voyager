<div class="form-group">
    <table class="understanding table table-bordered" id="{{$name}}">
        <thead>
            <tr>
                <th colspan="2" class="font-weight-normal align-top">{!! $title !!}</th>
                @foreach ($headers as $item)
                <th class="text-center font-weight-normal">{{$item}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $key => $row)
            <tr>
                <td class="d-none d-md-table-cell align-middle fixed-w-40">{{$row['no']}}</td>
                <td class="title-question"><label class="d-inline d-md-none">{{$row['no']}}</label>{!! $row['html'] !!}
                    <div id="{{$name}}_{{$key}}Error"></div>
                    <input type="hidden" name="{{$name}}[{{$key}}][text]" value="{{ $row['text'] }}">
                </td>
                @for($i = 0; $i < count($headers); $i++)
                <td class="text-md-center align-middle">
                    <input type="radio" name="{{$name}}[{{$key}}][val]" id="{{$name}}{{$key}}{{$i+1}}" value="{{$i+1}}" data-error="#{{$name}}_{{$key}}Error">
                    <span class="d-md-none d-inline" onclick="$('#{{$name}}{{$key}}{{$i+1}}').iCheck('toggle');">{{$headers[$i]}}</span>
                </td>
                @endfor
            </tr>
            @endforeach
        </tbody>
    </table>
</div>