@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('voyager::generic.login') }}</div>
                <div class="card-body">
                <form method="POST" action="{{route('anket.verify')}}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">担当医名</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('doctorName') is-invalid @enderror" name="doctorName" value="{{ old('doctorName') }}" autocomplete="doctorName" autofocus>
                                @error('doctorName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('voyager::generic.login') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection