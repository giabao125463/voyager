<div class="row">
    <div class="col-md-12">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <h3 class="panel-title">
                    @if ($errors->any())
                        @if($errors->has('update-failed'))
                            {{__('anket.patient') . '編集'}}
                        @else
                            {{__('anket.patient') . '登録'}}
                        @endif
                    @else
                        {{__('anket.patient') . '登録'}}
                    @endif
                </h3>
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="form-group has-error" id="errorDiv">
                            @foreach ($errors->all() as $error)
                                @if($error !== 'Failed')
                                    <p class="help-block">{{$error}}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <form id="anket-form" method="POST"
                          action="
                                        @if($errors->has('update-failed'))
                                            {{route('anket_accesses.edit')}}
                                        @else
                                            {{route('anket_accesses.create')}}
                                        @endif
                                  ">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-inline">
                                <label class="form-group">ログインID<span class="attention">必須 </span></label>
                                <input name="patient_code" type="text" class="form-control @error('patient_code') is-invalid @enderror" id="username" placeholder="O2281" value="{{old('patient_code') ?? ''}}">
                            </div>
                            <div class="col-md-6 form-inline">
                                <label class="form-group">パスワード<span class="attention">必須 </span>　　</label>
                                <input name="anket_password" type="text" class="form-control @error('anket_password') is-invalid @enderror" id="password"  value="{{old('anket_password') ?? ''}}">
                                <button type="button" gen-for="password" class="btn btn-warning btn-gen m-0">{{__('users.generate')}}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-inline">
                                <label class="form-group">{{ __('anket.hospital')}}　　　　　　　</label>
                                <select name="hospital_id" class="form-control @error('hospital_id') is-invalid @enderror" onchange="changeHospital(this.value)" id="hospitalId">
                                    @foreach ($hospitals as $item)
                                    <option value="{{$item->id}}" data-ankets="{{$item->ankets}}" {{old('hospital_id', '') == $item->id? 'selected' : ''}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-inline">
                                <label class="form-group">担当医<span class="attention">必須 </span>　　　　</label>
                                <select name="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" id="doctorId"></select>
                            </div>
                        </div>
                        <div class="form-inline form-group">
                            <label class="form-group">{{ __('anket.type') }}　　</label>
                            <select name="anket_id" class="form-control @error('anket_id') is-invalid @enderror" id="anketTypes"></select>
                        </div>
                        <div class="form-inline">
                            <label class="form-group">　　　　　　　</label>
                            <button type="submit" id="action-button" class="btn btn-primary">
                                @if($errors->has('update-failed'))
                                    更新
                                @else
                                    作成
                                @endif
                            </button>
                            <a href="{{ route('voyager.anket-accesses.index')}}" class="btn btn-default" id="btnCancel" @if(!$errors->has('update-failed')) style="display:none" @endif>キャンセル</a>
                            <input type="hidden" id="access-id" name="id" value="{{old('id') ?? ''}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>