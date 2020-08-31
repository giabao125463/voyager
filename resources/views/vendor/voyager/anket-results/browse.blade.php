@extends('voyager::master')
@section('page_title')
{{ config('app.name') }}／{{ __('anket.results')}}
@stop
@section('breadcrumbs')
    <ol class="breadcrumb hidden-xs">
        <li><i class="voyager-documentation"></i> {{ __('anket.name')}}</li>
        <li>{{ __('anket.result')}}</li>
    </ol>
@endsection

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-documentation"></i> {{ __('anket.results') }}
        </h1>
        @include('voyager::anket-results.form')
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="alerts"></div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>患者コード</th>
                                        <th>{{ __('anket.type') }}</th>
                                        <th>担当医名</th>
                                        <th>{{ __('anket.hospital')}}</th>
                                        <th>実施日</th>
                                        <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($anketResults as $anketResult)
                                    <tr>
                                        <td>{{$anketResult->anketAccess->patient_code}}</td>
                                        <td>{{$anketTypes[$anketResult->anket_id]}}</td>
                                        <td>{{$anketResult->doctor->name}}</td>
                                        <td>{{$anketResult->hospital->name}}</td>
                                        <td>{{$anketResult->created_at}}</td>
                                        <td class="no-sort no-click text-right" id="bread-actions">
                                            <a href="{{route('anket_result.history',['id' => $anketResult->anket_access_id])}}" title="履歴" class="btn btn-sm btn-warning pull-right detail-history" data-id="1" id="">
                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">履歴</span>
                                            </a>
                                            <a href="{{route('anket.edit', ['resultId' => $anketResult->id])}}" title="編集" class="btn btn-sm btn-primary pull-right edit">
                                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">編集</span>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-primary pull-right edit-patient-code" 
                                                data-patient-id="{{$anketResult->anket_access_id}}" 
                                                data-patient-code="{{$anketResult->anketAccess->patient_code}}"
                                                data-anket-id="{{$anketResult->anket_id}}">
                                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">患者コード</span>
                                            </a>
                                        </td>
                                    </tr>
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
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal">
        <div class="modal-dialog" role="document">
            <form id="updateForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">患者コード更新</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="anket_label">患者コード</label>
                            <input type="text" class="form-control" id="patientCode" name="patient_code">
                            <span class="mt-1 text-danger" id="patient_code_error"></span>
                            <input type="hidden" class="form-control" id="patientId" name="patient_id">
                            <input type="hidden" class="form-control" id="anketId" name="anket_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button id="updatePatientCode" type="button" class="btn btn-primary">更新</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('voyager::generic.close')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('javascript')
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            // customize by iCheck plugin (will search for checkboxes and radio buttons)
            $('input:not(.no-icheck)').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });

            $('input').on('ifChecked', function(){
                if($(this).val() == 'all') {
                    $('#checkAll').data('script', 0);
                    $('input[name="hospitals[]"]').each(function() {
                        $(this).iCheck('check');
                    });
                } else {
                    var all = true;
                    $('input[name="hospitals[]"]').each(function() {
                        var target = $(this);
                        if(target.val() != 'all') {
                            all = all && $(this).is(':checked');
                        }
                    });
                    if(all) {
                        $('#checkAll').iCheck('check');
                    }
                }
            });
            $('input').on('ifUnchecked', function(){
                var target = $(this);
                if(target.val() == 'all') {
                    if(target.data('script') == 1) {
                        // Disable uncheck all in case event from script.
                        $('#checkAll').data('script', 0);
                        return;
                    }
                    $('input[name="hospitals[]"]').each(function() {
                        $(this).iCheck('uncheck');
                    })
                } else {
                    $('#checkAll').data('script', 1);
                    $('#checkAll').iCheck('uncheck');
                }
            });
            $('.edit-patient-code').click(function() {
                var target = $(this);
                $('#patientCode').val(target.data('patient-code'));
                $('#patientId').val(target.data('patient-id'));
                $('#anketId').val(target.data('anket-id'));
                $('#updateModal').modal('show');
            });
            $('#updatePatientCode').click(function(e) {
                e.preventDefault();
                let formData = $('#updateForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{route('anket_accesses.updatePatient')}}',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        var errMsg = '';
                        if(data.status == 'success') {
                            location.reload();
                        } else if(data.status == 'existed') {
                            errMsg = '患者コードが存在しました。';
                        } else {
                            errMsg = '患者コードの更新に失敗しました。';
                        }
                        $('#patient_code_error').text(errMsg).show();
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = JSON.parse(xhr.responseText);
                        $('#patient_code_error').text(errorMessage.errors.patient_code[0]).show();
                    }
                });
            });

            $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [[4, 'desc']],
                        "language" => __('datatable'),
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                        "info" => false,
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true) !!});

                
            $("#dataTable_wrapper .row:nth-child(1) .col-sm-6:nth-child(2)").append(
                "<div class='dropdown pull-right btn-csv'>" +
                    "<button class=\"btn btn-sm btn-primary edit-patient-code dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">" +
                    "<i class='voyager-download'></i><span class='hidden-xs hidden-sm'> CSVダウンロード</span>" +
                    "</button>" +
                    "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">" +
                        "<a class=\"dropdown-item\" onClick=\"exportCsv('anket_39')\">登録時_LupusPRO・SF-12</a>" +
                        "<a class=\"dropdown-item\" onClick=\"exportCsv('anket_26')\">追跡時_LupusPRO・SF-12</a>" +
                    "</div>" +
                "</div>"
            )
        });

        function exportCsv(anket_type){
            switch (anket_type) {
                case 'anket_39':
                    url = "{{route('export', 'anket_39')}}";
                break;
                case 'anket_26':
                    url = "{{route('export', 'anket_26')}}";
                break
            }
            $('#anket-form').attr('action', url); 
            $('#anket-form').submit();
            $('#anket-form').attr('action', ''); 
        }
    </script>
@stop
