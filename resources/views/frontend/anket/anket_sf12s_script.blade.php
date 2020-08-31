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
                    qa1: 'required',
                    'qa2[0][val]': 'required',
                    'qa2[1][val]': 'required',
                    'qa3[0][val]': 'required',
                    'qa3[1][val]': 'required',
                    'qa4[0][val]': 'required',
                    'qa4[1][val]': 'required',
                    qa5: 'required',
                    'qa6[0][val]': 'required',
                    'qa6[1][val]': 'required',
                    'qa6[2][val]': 'required',
                    qa7: 'required',
                },
                messages: {
                    qa1: msgReqCheck,
                    'qa2[0][val]': msgReqAnswer,
                    'qa2[1][val]': msgReqAnswer,
                    'qa3[0][val]': msgReqAnswer,
                    'qa3[1][val]': msgReqAnswer,
                    'qa4[0][val]': msgReqAnswer,
                    'qa4[1][val]': msgReqAnswer,
                    qa5: msgReqCheck,
                    'qa6[0][val]': msgReqAnswer,
                    'qa6[1][val]': msgReqAnswer,
                    'qa6[2][val]': msgReqAnswer,
                    qa7: msgReqCheck,
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