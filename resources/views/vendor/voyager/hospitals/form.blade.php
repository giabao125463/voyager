<div class="row">
    <div class="col-md-12">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <h3 class="panel-title">
                    @if ($errors->any())
                        @if($errors->has('update-failed'))
                            {{__('anket.hospital') . '編集'}}
                        @else
                            {{__('anket.hospital') . '登録'}}
                        @endif
                    @else
                        {{__('anket.hospital') . '登録'}}
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
                                            {{route('hospitals.edit', ['hospital' => old('id') ?? ''])}}
                                        @else
                                            {{route('hospitals.create')}}
                                        @endif
                                  ">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-inline">
                                <label class="form-group" for="hospitalName">病院名<span class="attention">必須 </span>　　　　</label>
                                <input name="name" type="text" maxlength="150" class="form-control @error('name') is-invalid @enderror" id="hospitalName" value="{{old('name') ?? ''}}">
                            </div>
                            <div class="col-md-6 form-inline">
                                <label class="form-group" for="hospitalCode">略号<span class="attention">必須 </span></label>
                                <input name="code" type="text" maxlength="10" class="form-control @error('code') is-invalid @enderror" id="hospitalCode" value="{{old('code') ?? ''}}">
                            </div>
                        </div>
                        <div class="form-inline form-group">
                            <label class="form-group" for="anket_types">{{ __('anket.type') }}<span class="attention">必須 </span></label>
                            <div class="form-group">
                                @foreach ($anketTypes as $key => $item)
                                    <label class="form-group"><input type="checkbox" name="anket_types[]" value="{{$key}}" @if(old('anket_types') && in_array($key, old('anket_types'))) checked @endif> {{$item}}</label>
                                @endforeach
                                <input type="hidden" id="id" name="id" value="{{old('id') ?? ''}}">
                            </div>
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
                            <a href="{{ route('voyager.hospitals.index')}}" class="btn btn-default" id="btnCancel" @if(!$errors->has('update-failed')) style="display:none" @endif>キャンセル</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
