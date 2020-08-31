@extends('voyager::master')
@section('breadcrumbs')
    <ol class="breadcrumb hidden-xs">
        @php
        $segments = array_filter(explode('/', str_replace(route('voyager.dashboard'), '', Request::url())));
        $url = route('voyager.dashboard');
        @endphp
        <li><a href="{{$url . '/' . $segments[1]}}"><i class="voyager-documentation"></i> {{__('anket.result')}}</a></li>
        <li class="active">{{__('anket.result_history')}}</li>
    </ol>
@endsection
@section('page_title', __('anket.result_history'))
@section('page_header')
    <h1 class="page-title-admin"><i class="voyager-documentation"></i>{{__('anket.result_history')}}</h1>
@stop
@section('content')
    <!--Table-->
    <div class="page-content browse container-fluid">
        <div class="alerts">
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12 pl-0">
                                        <table id="dataTable" class="table table-hover table-register dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable">患者コード</th>
                                                <th class="sorting" tabindex="1" aria-controls="dataTable">{{ __('anket.type') }}</th>
                                                <th class="sorting" tabindex="2" aria-controls="dataTable">更新日</th>
                                                <th class="sorting" tabindex="3" aria-controls="dataTable">更新者</th>
                                                <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($anketResults as $anketResult)
                                                    <tr>
                                                        <td>{{$anketResult->anketAccess ? $anketResult->anketAccess->patient_code : $anketResult->user->name}}</td>
                                                        <td>{{$anketTypes[$anketResult->anket_id]}}</td>
                                                        <td>{{$anketResult->created_at}}</td>
                                                        <td>{{$anketResult->user? $anketResult->user->name : $anketResult->anketAccess->patient_code}}</td>
                                                        <td class="no-sort no-click text-right" id="bread-actions">
                                                            <a href="{{route('anket.view', ['historyId' => $historyId, 'resultId' => $anketResult->id])}}" class="btn btn-sm btn-primary pull-right"><i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">詳細</span></a>
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
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [[2, 'desc']],
                        "language" => __('datatable'),
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                        "info" => false,
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true) !!});
    </script>
@stop
