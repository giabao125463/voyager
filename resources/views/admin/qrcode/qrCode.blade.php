<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<div class="text-center">
    {!! QrCode::size(250)->generate(route('admin.ankets.qrCodeGen', ['qr_code' => $qr_code, 'hospital_id' => $hospital_id, 'anket_id' => $anket_id])); !!}
</div>

</body>
</html>
