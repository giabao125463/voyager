<div class="form-group">
    <table class="understanding table table-bordered" id="{{$name}}">
        <thead>
            <tr>
                <th colspan="2" class="font-weight-normal align-top">{!! $title !!}</th>
                @foreach ($headers as $item)
                <th class="text-center table-header font-weight-normal">{{$item}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $key => $row)
            <tr>
                <td class="d-none d-md-table-cell align-middle fixed-w-40">{{$begin + $key + 1}}</td>
                <td class="title-question"><span class="d-inline d-md-none">{{$begin + $key + 1}}</span>{{$row}}
                    <div id="{{$name}}_{{$key}}Error"></div>
                    <input type="hidden" name="{{$name}}[{{$key}}][text]" value="{{$row}}">
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