@push('javascript')
    <script>
        // Edit Anket data
        var oldData;
        @if(isset($result))
            jsonData = '{!! $result->answers !!}'.replace(/\r/g, '\\r').replace(/\n/g, '\\n');
            oldData = JSON.parse(jsonData);
        @endif

        $(function() {
            if(oldData != undefined) {
                setRadioData();
            }
            // customize by iCheck plugin (will search for checkboxes and radio buttons)
            $('input:not(.no-icheck)').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });
            addListeners();
            resetRadio();
            addFormValidate();
            checkBeforeSubmit();
        });

        function addFormValidate() {
            $("#anketForm").validate({
                rules: {
                    'qaA[0][val]': 'required',
                    'qaA[1][val]': 'required',
                    'qaA[2][val]': 'required',
                    'qaA[3][val]': 'required',
                    'qaA[4][val]': 'required',
                    'qaA[5][val]': 'required',
                    'qaA[6][val]': 'required',
                    'qaA[7][val]': 'required',
                    'qaA[8][val]': 'required',
                    'qaB[0][val]': 'required',
                    'qaB[1][val]': 'required',
                    'qaB[2][val]': 'required',
                    'qaB[3][val]': 'required',
                    'qaB[4][val]': 'required',
                    'qaC[0][val]': 'required',
                    'qaC[1][val]': 'required',
                    'qaC[2][val]': 'required',
                    'qaC[3][val]': 'required',
                    'qaC[4][val]': 'required',
                    'qaD[0][val]': 'required',
                    'qaD[1][val]': 'required',
                    'qaD[2][val]': 'required',
                    'qaD[3][val]': 'required',
                    'qaD[4][val]': 'required',
                    'qaD[5][val]': 'required',
                    'qaE[0][val]': 'required',
                    'qaE[1][val]': 'required',
                    'qaE[2][val]': 'required',
                    'qaE[3][val]': 'required',
                    'qaE[4][val]': 'required',
                    'qaF[0][val]': 'required',
                    'qaF[1][val]': 'required',
                    'qaF[2][val]': 'required',
                    'qaF[3][val]': 'required',
                    'qaG[0][val]': 'required',
                    'qaG[1][val]': 'required',
                    'qaG[2][val]': 'required',
                    'qaG[3][val]': 'required',
                    'qaG[4][val]': 'required',
                    'qaH[0][val]': 'required',
                    'qaH[1][val]': 'required',
                    'qaH[2][val]': 'required',
                    'qaH[3][val]': 'required',
                },
                messages: {
                    'qaA[0][val]': msgReqAnswer,
                    'qaA[1][val]': msgReqAnswer,
                    'qaA[2][val]': msgReqAnswer,
                    'qaA[3][val]': msgReqAnswer,
                    'qaA[4][val]': msgReqAnswer,
                    'qaA[5][val]': msgReqAnswer,
                    'qaA[6][val]': msgReqAnswer,
                    'qaA[7][val]': msgReqAnswer,
                    'qaA[8][val]': msgReqAnswer,
                    'qaB[0][val]': msgReqAnswer,
                    'qaB[1][val]': msgReqAnswer,
                    'qaB[2][val]': msgReqAnswer,
                    'qaB[3][val]': msgReqAnswer,
                    'qaB[4][val]': msgReqAnswer,
                    'qaC[0][val]': msgReqAnswer,
                    'qaC[1][val]': msgReqAnswer,
                    'qaC[2][val]': msgReqAnswer,
                    'qaC[3][val]': msgReqAnswer,
                    'qaC[4][val]': msgReqAnswer,
                    'qaD[0][val]': msgReqAnswer,
                    'qaD[1][val]': msgReqAnswer,
                    'qaD[2][val]': msgReqAnswer,
                    'qaD[3][val]': msgReqAnswer,
                    'qaD[4][val]': msgReqAnswer,
                    'qaD[5][val]': msgReqAnswer,
                    'qaE[0][val]': msgReqAnswer,
                    'qaE[1][val]': msgReqAnswer,
                    'qaE[2][val]': msgReqAnswer,
                    'qaE[3][val]': msgReqAnswer,
                    'qaE[4][val]': msgReqAnswer,
                    'qaF[0][val]': msgReqAnswer,
                    'qaF[1][val]': msgReqAnswer,
                    'qaF[2][val]': msgReqAnswer,
                    'qaF[3][val]': msgReqAnswer,
                    'qaG[0][val]': msgReqAnswer,
                    'qaG[1][val]': msgReqAnswer,
                    'qaG[2][val]': msgReqAnswer,
                    'qaG[3][val]': msgReqAnswer,
                    'qaG[4][val]': msgReqAnswer,
                    'qaH[0][val]': msgReqAnswer,
                    'qaH[1][val]': msgReqAnswer,
                    'qaH[2][val]': msgReqAnswer,
                    'qaH[3][val]': msgReqAnswer,
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        }

        function addListeners() {
            $('input').on('ifChecked', function(event) {
                var target = $(event.target);
                $(target.data('error')).hide();
            });
        }
    </script>
@endpush