<div class="row">
    <div class="col-md-12">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <h3 class="panel-title">
                    {{__('anket.result') . __('voyager::generic.search')}}
                </h3>
                <div class="col-md-12">
                    @if (count($errors) > 0)
                        <div class="form-group has-error">
                            @foreach ($errors->all() as $error)
                                <p class="help-block">{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                    <form id="anket-form" method="GET" action="">
                        <div class="row">
                            <div class="col-md-3 form-inline">
                                <label class="form-group" for="username">{{ __('users.patient_code') }}</label>
                                <input name="patient_code" type="text" class="form-control" id="username" value="{{request()->patient_code ?? ''}}">
                            </div>
                            <div class="col-md-3 form-inline">
                                <label class="form-group" for="doctor_name">{{ __('users.doctor_name') }}</label>
                                <input name="doctor_name" type="text" class="form-control" id="doctor_name" value="{{request()->doctor_name ?? ''}}">
                            </div>
                            <div class="col-md-6 form-inline">
                                <label class="form-group" for="password-retype">{{ __('users.anket_type') }}</label>
                                <select name="anket_id" id="anket-id" class="form-control">
                                    <option value="all">全て</option>
                                    @foreach(config('consts.anketo.qrcode') as $value => $label)
                                        <option {{request()->anket_id == $value ? 'selected' : ''}} value="{{$value}}">{{$label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-inline form-group">
                            <label class="form-group">{{ __('anket.hospitals')}}:　　　</label>
                            @foreach ($hospitals as $item)
                                <label class="form-group"><input type="checkbox" name="hospitals[]" value="{{$item['id']}}" @if(request()->hospitals && in_array($item['id'], request()->hospitals)) checked @endif> {{$item['name']}}</label>
                            @endforeach
                        </div>
                        <div class="form-inline">
                            <label class="form-group">　　　　　</label>
                            <button type="submit" class="btn btn-primary">{{ __('voyager::generic.search') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>