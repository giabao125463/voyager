@extends('voyager::master')
@section('page_title')
{{ config('app.name') }}／{{ __('anket.executives') }}
@stop
@section('breadcrumbs')
    <ol class="breadcrumb hidden-xs">
        <li><i class="voyager-person"></i> ユーザー管理</li>
        <li> {{ __('anket.executives') }}</li>
    </ol>
@endsection

@section('page_header')
    <div class="container-fluid" id="pageHeader">
        <h1 class="page-title">
            <i class="voyager-person"></i> {{ __('anket.executives') }}
        </h1>
        @include('voyager::executives.form')
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
                                    <th>ログインID</th>
                                    <th>登録日時</th>
                                    <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="no-sort no-click text-right" id="bread-actions">
                                        @if($item->name !== 'admin')
                                            <a href="javascript:;" title="削除" class="btn btn-sm btn-danger pull-right delete"
                                            data-id="{{$item->id}}"
                                            data-action="{{route('doctor.delete', ['id' => $item->id])}}">
                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">削除</span>
                                            </a>
                                        @endif
                                        <a href="javascript:void(0)" title="編集" class="btn btn-sm btn-primary pull-right edit-executives"
                                            data-id="{{$item->id}}"
                                            data-name="{{$item->name}}"
                                            data-hospitals="{{$item->hospitalIds}}"
                                            data-action="{{route('doctor.update')}}">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">{{ $errors->has('update-failed') && $item->id == old('id')? '編集中' : '編集' }}</span>
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
</div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            
            // customize by iCheck plugin (will search for checkboxes and radio buttons)
            $('input:not(.no-icheck)').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });

            $('td').on('click', '.delete', function () {
                $('#delete_form').attr('action', $(this).data('action'));
                $('#delete_modal').modal('show');
            });

            $('.edit-executives').on('click',function(){
                var target = $(this);
                $('.panel-body .panel-title').text('管理者編集');
                $('#action-button').html('更新');
                $('#id').val(target.data('id'));
                $('#username').val(target.data('name'));
                $('#username').attr('readonly',true);
                var hospitals = target.data('hospitals');
                $('input[name="hospitals[]"]').each(function() {
                    var input = $(this);
                    var value = input.val();
                    if(value != 'all' && hospitals.includes(parseInt(value))) {
                        input.iCheck('check');
                    } else {
                        input.iCheck('uncheck');
                    }
                });
                $('#doctor-form').attr('action', "{{route('doctor.update')}}");
                $('.data-row').css('background-color','#fff');
                $('#row_'+target.data('id')).css('background-color','#eaeaea');
                $('.edit-doctor').html("<i class='voyager-edit'></i> <span class='hidden-xs hidden-sm'>編集");
                target.html("<i class='voyager-edit'></i> <span class='hidden-xs hidden-sm'>編集中");
                $('#btnCancel').show();
                $('#errorDiv').hide();
                // Auto scroll
                $('html, body').animate({
                    scrollTop: $("#pageHeader").offset().top
                }, 100);
            });
            $('#dataTable').DataTable({!! json_encode(
                array_merge([
                    "order" => [[1, 'desc']],
                    "language" => __('datatable'),
                    "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    "info" => false,
                ],
                config('voyager.dashboard.data_tables', []))
            , true) !!});
        });
    </script>
@stop
