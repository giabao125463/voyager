@extends('voyager::master')

@section('page_title')
{{ config('app.name') }}／{{ __('anket.patient')}}
@stop
@section('breadcrumbs')
    <ol class="breadcrumb hidden-xs">
        <li><i class="voyager-person"></i>ユーザー管理</li>
        <li>{{ __('anket.patient')}}</li>
    </ol>
@endsection

@section('page_header')
    <div class="container-fluid" id="pageHeader">
        <h1 class="page-title">
            <i class="voyager-person"></i> {{ __('anket.patient') }}
        </h1>
        @include('voyager::anket-accesses.form')
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
                                    <th>パスワード</th>
                                    <th>{{ __('anket.type') }}</th>
                                    <th>担当医</th>
                                    <th>登録日時</th>
                                    <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anketAccesses as $item)
                                <tr>
                                    <td>{{$item->patient_code}}</td>
                                    <td>{{$item->password}}</td>
                                    <td>{{ $anketTypes[$item->anket_id] }}</td>
                                    <td>{{$item->doctor->name}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="no-sort no-click text-right" id="bread-actions">
                                        <a href="javascript:;" title="削除" class="btn btn-sm btn-danger pull-right delete"
                                            data-action="{{route('anket_accesses.delete', ['id' => $item->id])}}">
                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">削除</span>
                                        </a>
                                        <a href="javascript:void(0)" title="編集" class="btn btn-sm btn-primary pull-right edit edit-anket-access"
                                            data-id="{{$item->id}}"
                                            data-patient_code="{{$item->patient_code}}"
                                            data-password="{{$item->password}}"
                                            data-hospital_id="{{$item->hospital_id}}"
                                            data-doctor_id="{{$item->doctor_id}}"
                                            data-anket_id="{{$item->anket_id}}">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">{{ $errors->has('update-failed') && $item->id == old('id')? '編集中' : '編集' }}</span>
                                        </a>
                                        <a href="javascript:;" title="QR" class="btn btn-sm btn-primary pull-right edit qrcode-popup"
                                            data-anket-label="{{$anketTypes[$item->anket_id]}}"
                                            data-hospital-id="{{$item->hospital_id}}"
                                            data-hospital_name="{{$item->hospital->name}}"
                                            data-patient_code="{{$item->patient_code}}"
                                            data-password="{{$item->password}}"
                                            data-anket_id="{{$item->anket_id}}">
                                            <i class="voyager-params"></i> <span class="hidden-xs hidden-sm">QR</span>
                                        </a>
                                        <a href="javascript:;" title="印刷" class="btn btn-sm btn-primary pull-right print"
                                            data-url="{{ route('anket.print', ['id' => $item->id]) }}">
                                            <i class="voyager-documentation"></i> <span class="hidden-xs hidden-sm">印刷</span>
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
    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }}</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- QRCode Modal -->
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
                            <input readonly type="text" class="form-control" id="hospital_label">
                            <input name="hospital_id" type="hidden" id="hospital_id">
                        </div>
                        <div class="form-group">
                            <label for="anket_label">{{__('users.patient_code')}}</label>
                            <input readonly type="text" class="form-control" id="patient_label">
                        </div>
                        <div class="form-group">
                            <label for="anket_label">{{__('users.password')}}</label>
                            <input readonly type="text" class="form-control" id="password_label">
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
</div>
@endsection
@section('javascript')
    <!-- DataTables -->
    <script>
        var anketTypes = {!! json_encode($anketTypes) !!};
        var loginId = '{{ old('doctor_id')?? $loginUser->id }}';

        $(function() {
            changeHospital($('#hospitalId option:selected').val(), loginId);

            $('.edit-anket-access').on('click',function(){
                var target = $(this);
                $('#username').val(target.data('patient_code'));
                $('#password').val(target.data('password'));
                var hospitalId = target.data('hospital_id');
                $('#hospitalId').val(hospitalId);
                changeHospital(hospitalId, target.data('doctor_id') );
                $('#anketTypes').val(target.data('anket_id'));

                $('.panel-body .panel-title').text('患者編集');
                $('#action-button').html('更新');
                $('#access-id').val(target.data('id'));
                $('#anket-form').attr('action', "{{route('anket_accesses.edit')}}");
                $('.data-row').css('background-color','#fff');
                $('#row_'+target.data('id')).css('background-color','#eaeaea');
                $('.edit-anket-access').html("<i class='voyager-edit'></i> <span class='hidden-xs hidden-sm'>編集");
                target.html("<i class='voyager-edit'></i> <span class='hidden-xs hidden-sm'>編集中");
                $('#btnCancel').show();
                $('#errorDiv').hide();
                // Auto scroll
                $('html, body').animate({
                    scrollTop: $("#pageHeader").offset().top
                }, 100);
            });

            $('td').on('click', '.delete', function () {
                $('#delete_form').attr('action', $(this).data('action'));
                $('#delete_modal').modal('show');
            });

            $('.qrcode-popup').click(function() {
                var target = $(this);
                $('#anket_label').val(target.data('anket-label'));
                $('#anket_id').val('login');
                $('#sel_anket_id').val(target.data('anket_id'));
                $('#hospital_id').val(target.data('hospital-id'));
                $('#hospital_label').val(target.data('hospital_name'));
                $('#patient_label').val(target.data('patient_code'));
                $('#password_label').val(target.data('password'));
                let formData = $('#QRForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{route('anket_accesses.createWithSurvey')}}',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        $('#status').hide();
                        $('#qr-code').html(data.html);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = JSON.parse(xhr.responseText);
                        console.log(errorMessage);
                        $('#patient_code_error').text(errorMessage.errors.patient_code[0]).show();
                    }
                });
                $('#QRFormModal').modal('show');
            });

            $('.print').click(function() {
                var url = $(this).data('url');
                var w = screen.width;
                var h = screen.height;
                var title = '';
                var left = 0;
                var top = 0;
                var doc = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
                doc.window.print();
                return false;
            });

            $('#QRFormModal').on('show.bs.modal', function() {
                $('#status').show();
                $('#username').val('');
                $('#qr-code').empty();
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
        });

        function changeHospital(value, doctorId) {
            $("#anketTypes").empty();
            $('#anketTypes').attr('disabled', true);
            var hospitalAnkets = $('select option[value="' + value + '"]').data('ankets');
            for(var i=0; i<hospitalAnkets.length; i++) {
                var anketId = hospitalAnkets[i];
                $("#anketTypes").append(new Option(anketTypes[anketId], anketId));
            }
            $("#anketTypes").removeAttr('disabled');

            $("#doctorId").attr('disabled', true);
            loadDoctors(value, doctorId);
        }

        function loadDoctors(hospitalId, doctorId) {
            $.ajax({
                type: 'POST',
                url: '{{route('anket_accesses.doctors')}}',
                data: {
                    'hospital_id': hospitalId
                },
                dataType: 'json',
                success: function(data) {
                    $("#doctorId").empty();
                    for(var i=0; i<data.length; i++) {
                        $("#doctorId").append(new Option(data[i].name, data[i].id));
                    }
                    $("#doctorId").val(doctorId);
                    $("#doctorId").removeAttr('disabled');
                },
                error: function(xhr, status, error) {
                    let errorMessage = JSON.parse(xhr.responseText);
                    console.log(errorMessage);
                }
            });
        }
    </script>
@stop