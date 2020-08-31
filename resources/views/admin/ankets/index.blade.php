@extends('voyager::master')

@section('page_title')
{{ config('app.name') }}／{{ __('anket.page_title') }}
@stop
@section('breadcrumbs')
    <ol class="breadcrumb hidden-xs">
        <li><i class="voyager-documentation"></i> {{ __('anket.name') }}</li>
        <li> {{ __('anket.page_title') }}</li>
    </ol>
@endsection

@section('page_title', __('voyager::generic.viewing').' '. __('anket.page_title'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="icon voyager-bubble"></i> {{ __('anket.page_title') }}
        </h1>
    </div>
@stop

@section('content')
   <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h3 class="panel-title">
                        病院名{{ __('voyager::generic.search')}}
                        </h3>
                        <div class="col-md-12">
                            <form id="anket-form" method="GET" action="">
                                <div class="form-inline form-group">
                                    <label class="form-group">病院名</label>
                                    <select name="hospitals" id="hospitals" class="form-control form-group">
                                        <option value="all">全て</option>
                                        @foreach($hospitalsList as $item)
                                            <option {{request()->hospitals == $item['id'] ? 'selected' : ''}} value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">{{ __('voyager::generic.search') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{__('anket.name')}}</th>
                                        <th>{{__('anket.hospital')}}</th>
                                        <th>{{__('voyager::generic.created_at')}}</th>
                                        <th class="text-right">{{__('anket.qrcode')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hospitalSearch as $hospital)
                                        @foreach(json_decode($hospital->ankets) as $anketId)
                                            <tr>
                                                <td>{{$anketTypes[$anketId]}}</td>
                                                <td>{{$hospital->name}}</td>
                                                <td>2020-02-20 10:20:35</td>
                                                <td class="no-sort no-click text-right" id="bread-actions">
                                                    <a href="#" title="編集" class="qrcode-popup btn btn-sm btn-primary pull-right"
                                                        data-anket-label="{{$anketTypes[$anketId]}}"
                                                        data-anket-id="{{$anketId}}"
                                                        data-hospital-id="{{$hospital->id}}"
                                                        data-hospital-label="{{$hospital->name}}">
                                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">取得</span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $key = $anketId.'_temp'; ?>
                                            @if(isset($anketTypes[$key]))
                                            <tr>
                                                <td>{{$anketTypes[$key]}}</td>
                                                <td>{{$hospital->name}}</td>
                                                <td>2020-02-20 10:20:35</td>
                                                <td class="no-sort no-click text-right" id="bread-actions">
                                                    <a href="#" title="編集" class="qrcode-popup btn btn-sm btn-primary pull-right"
                                                        data-anket-label="{{$anketTypes[$key]}}"
                                                        data-anket-id="{{$key}}"
                                                        data-hospital-id="{{$hospital->id}}"
                                                        data-hospital-label="{{$hospital->name}}">
                                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">取得</span>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="QRFormModal" tabindex="-1" role="dialog" aria-labelledby="QRFormModalLabel">
  <div class="modal-dialog" role="document">
      <form id="QRForm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="QRFormModalLabel">{{__('anket.qrcode')}}</h4>
              </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="anket_label">{{__('anket.name')}}</label>
                        <input readonly name="anket_label" type="text" class="form-control" id="anket_label">
                        <input name="anket_id" type="hidden" id="anket_id">
                        <input name="sel_anket_id" type="hidden" id="sel_anket_id">
                    </div>
                    <div class="form-group">
                        <label for="anket_label">{{__('anket.hospital')}}</label>
                        <input readonly type="text" class="form-control" id="anket_hospital">
                        <input name="hospital_id" type="hidden" id="hospital_id">
                    </div>
                    <div class="form-group">
                        <div id="status">QRコードの生成中。。。</div>
                        <div id="qr-code"></div>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('voyager::generic.close')}}</button>
              </div>
          </div>
      </form>
  </div>
</div>
@stop

@section('javascript')
<script>
    $(function() {
        $('#QRFormModal').on('show.bs.modal', function() {
            $('#status').show();
            $('#username').val('');
            $('#qr-code').empty();
        });
        $('.qrcode-popup').click(function() {
            var target = $(this);
            $('#anket_label').val(target.data('anket-label'));
            $('#anket_id').val(target.data('anket-id'));
            $('#sel_anket_id').val(target.data('anket-id'));
            $('#anket_hospital').val(target.data('hospital-label'));
            $('#hospital_id').val(target.data('hospital-id'));
            $('#QRFormModal').modal('show');

            let formData = $('#QRForm').serialize();
            $.ajax({
                type: 'POST',
                url: '{{route('anket_accesses.createWithSurvey')}}',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    $('#status').hide();
                    $('#qr-code').html(data.html);
                    $('#patient_code_error').empty().hide();
                    $('#qr-gen').hide();
                },
                error: function(xhr, status, error) {
                    let errorMessage = JSON.parse(xhr.responseText);
                    console.log(errorMessage);
                    $('#patient_code_error').text(errorMessage.errors.patient_code[0]).show();
                }
            });
        });
        var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [[2, 'desc']],
                        "language" => __('datatable'),
                        "columnDefs" => [['targets' => 2, 'searchable' =>  false, 'orderable' => false]],
                        "info" => false,
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true) !!});

    })
</script>
@stop
