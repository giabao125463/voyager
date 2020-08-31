<div class="row">
    <div class="col-md-12">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <h3 class="panel-title">
                    @if ($errors->any())
                        @if($errors->has('update-failed'))
                            {{__('anket.doctor') . '編集'}}
                        @else
                            {{__('anket.doctor') . '登録'}}
                        @endif
                    @else
                        {{__('anket.doctor') . '登録'}}
                    @endif
                </h3>
                <div class="col-md-12">
                    @if (count($errors) > 0)
                        <div class="form-group has-error" id="errorDiv">
                            @foreach ($errors->all() as $error)
                                @if($error !== 'Failed')
                                    <p class="help-block">{{$error}}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <form id="doctor-form" method="POST" action="
                             @if($errors->has('update-failed'))
                                {{route('doctor.update')}}
                            @else
                                {{route('doctor.create')}}
                            @endif
                        ">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-inline">
                                <label class="form-group" for="username">{{ __('users.doctor_label') }}<span class="attention">必須 </span></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="D0001" value="{{old('username') ?? ''}}"
                                    @if($errors->has('update-failed')) readonly @endif>
                            </div>
                            <div class="col-md-6 form-inline">
                                <label class="form-group" for="password">{{ __('voyager::generic.password') }}<span class="attention">必須 </span></label>
                                <input type="text" class="form-control @error('doctor_password') is-invalid @enderror" id="password" name="doctor_password" value="{{old('doctor_password') ?? ''}}">
                                <button type="button" gen-for="password" class="btn btn-warning btn-gen">{{__('users.generate')}}</button>
                                
                            </div>
                        </div>
                        <div class="form-inline form-group">
                            <label class="form-group" for="hospitals">{{ __('anket.hospitals')}}<span class="attention">必須 </span>　　　</label>
                            <div class="form-group">
                                @foreach ($hospitals as $item)
                                    <label class="form-group"><input type="checkbox" name="hospitals[]" value="{{$item->id}}" @if(old('hospitals') && in_array($item->id, old('hospitals'))) checked @endif> {{$item->name}}</label>
                                @endforeach
                                <input type="hidden" id="id" name="id" value="{{old('id') ?? ''}}">
                            </div>
                        </div>
                        <div class="form-inline">
                            <label class="form-group">　　　　　</label>
                            <button type="submit" id="action-button" class="btn btn-primary">
                                    @if($errors->has('update-failed'))
                                        更新
                                    @else
                                        作成
                                    @endif
                                </button>
                                <a href="{{ route('voyager.users.index')}}" class="btn btn-default" id="btnCancel" @if(!$errors->has('update-failed')) style="display:none" @endif>キャンセル</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>