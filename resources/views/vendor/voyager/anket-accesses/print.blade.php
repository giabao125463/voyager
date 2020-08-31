<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ログイン情報</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
</head>
<body class="bg-light" onafterprint="afterPrint()">
    <div class="container">
        <div class="form-group">
            <br><br><br><br>
        </div>
        <div class="form-group">
            <div class="card">
                <div class="card-header text-center"><h4>患者のログイン情報</h4></div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <p>{{ __('anket.name') }}</p>
                            <p class="pl-4"><b>{{ $anketName }}</b></p>
                            <p>患者コード(ログインID)</p>
                            <p class="pl-4"><b>{{ $anketAccess->patient_code }}</b></p>
                            <p>患者パスワード(ログインパスワード)</p>
                            <p class="pl-4"><b>{{ $anketAccess->password }}</b></p>
                            <p>※アンケート回答後はパスワードを塗りつぶすなど他人にわからないようにしてこの用紙を処分してください。</p>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <p>{{ __('anket.qrcode') }}</p>
                                {!! QrCode::size(250)->generate(route('admin.ankets.qrCodeGen', ['qr_code' => 'login', 'hospital_id' => 'access', 'anket_id' => $anketAccess->anket_id])); !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-inline">
                        <a href="#" class="btn btn-primary mr-1" style="display:none" id="btnPrint">印刷</a>
                        <a href="#" class="btn btn-secondary" style="display:none" id="btnClose">閉じる</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script>
        $(function() {
            $('#btnClose').click(function() {
                window.close();
            });

            $('#btnPrint').click(function() {
                $('a.btn').each(function() {
                    $(this).hide();
                });
                window.print();
            });
        });

        function afterPrint() {
            $('a.btn').each(function() {
                $(this).show();
            });
        }
    </script>
</body>
</html>