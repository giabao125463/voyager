@extends('layouts.front')
@php
    $anketId = ($anketId == 'anket_39' || $anketId == 'anket_26')? 'common' : $anketId;
@endphp
@section('page_title') {{ data_get($anketDescription, 'title.' . $anketId)}} @endsection

@section('head')
@endsection

@section('content')
<div class="form-group"></div>
<div class="text-justify">
    <ul class="p-header">
        @foreach (data_get($anketDescription, 'about.' . $anketId) as $item)
        <li>{!! $item !!}</li>
        @endforeach
    </ul>
</div>
<div class="mt-4 text-center form-group">
    @foreach (data_get($anketDescription, 'about.' . $anketId . '_footer') as $item)
        {!! $item !!}
    @endforeach
</div>
<div class="text-right form-group">
    <a class="btn btn-secondary" href="{{ url()->previous() . ($anketId == 'anket_sf12s'? '#sf12' : '') }}">アンケートに戻る</a>
</div>
@endsection
