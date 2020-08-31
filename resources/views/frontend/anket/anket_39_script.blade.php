@push('javascript')
    <script>
        // Edit Anket data
        var oldData;
        @if(isset($result))
            jsonData = '{!! $result->answers !!}'.replace(/\r/g, '\\r').replace(/\n/g, '\\n');
            oldData = JSON.parse(jsonData);
        @endif

        $(function() {
            // add init data
            var jsonData = '{"understanding": [{  "no": "１",  "name": "先生は，私がわかるような言葉で病名を教えてくれた"},{  "no": "２",  "name": "先生と話して，私の病名の重さが正確にわかった"},{  "no": "３",  "name": "先生と話して，今後数週間から数ヵ月間に体の具合がどうなっていくのかよくわかった"},{  "no": "４",  "name": "先生は，私が病気のことで知りたかったことをみんな教えてくれた"},{  "no": "５",  "name": "先生は、検査の理由を上手に説明してくれた"},{  "no": "６",  "name": "先生は、この病気が仕事にどのくらい差しつかえるかを教えてくれた"},{  "no": "７",  "name": "先生は、重病になってしまうんじゃないかという心配を和らげてくれた"},{  "no": "８",  "name": "先生は、処方した薬がどのように効くのかを教えてくれた"},{  "no": "９",  "name": "先生が、今後何をしてくれるつもりなのかが十分にわかったような気がする"},{  "no": "１０",  "name": "先生は、私が本当に気になっていたことを話す機会を作ってくれた"},{  "no": "１１",  "name": "私は、本当に先生にわかってもらえたと感じた"},{  "no": "１２",  "name": "私は、先生に相談してかなり具合がよくなったと感じた"},{  "no": "１３",  "name": "私が痛くてどのくらいまいっているか、先生は本当にわかってくれたと感じた"},{  "no": "１４",  "name": "私は、プライベートなことを先生にはありのまま話せると感じた"},{  "no": "１５",  "name": "私を一人の人間として先生は受け入れてくれたと感じた"},{  "no": "１６",  "name": "先生は、私の問題が重大だと考えているようには思えなかった"},{  "no": "１７",  "name": "先生は、私に好意的ではなかった"},{  "no": "１８",  "name": "私が今日診察してもらった先生は、いのちを預けてもよい人である"},{  "no": "１９",  "name": "先生は、私を徹底的に診察してくれた"},{  "no": "２０",  "name": "先生は、診察するときかなり荒っぽかった"},{  "no": "２１",  "name": "先生は、私が話した問題すべてに対応してくれた"},{  "no": "２２",  "name": "私に必要な治療として先生が下した判断に満足できた"},{  "no": "２３",  "name": "先生は、私の診察に十分な時間をかけてくれたとは思わない"},{  "no": "２４",  "name": "先生は、私の診察の間中忙しそうにみえた"},{  "no": "２５",  "name": "先生は、私を診察するときかなりせっかちに指示した"},{  "no": "２６",  "name": "先生は、私を一生懸命に診察してくれたようにみえた"}]}';
            var data = oldData == undefined? JSON.parse(jsonData).understanding : oldData.qa39;
            for(var i=0; i<data.length; i++) {
                var template = '<tr>'
                    + '<td class="d-none d-md-table-cell align-middle">' + data[i].no + '</td>'
                    + '<td class="title-question"><span class="d-inline d-md-none">'+ data[i].no +'</span>' + data[i].name
                    + '<div id="understand_' + i +'Error"></div>'
                    + '<input type="hidden" value="' + data[i].no + '" name="qa39[' + i + '][no]">'
                    + '<input type="hidden" value="' + data[i].name + '" name="qa39[' + i + '][name]">'
                    + '</td>';
                switch(data[i].understand) {
                    case '1':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '1" checked value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '2':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '2" checked value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '3':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" checked value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '4':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '4" checked value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '5':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '5" checked value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    default:
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa39[' + i + '][understand]" id="qa39' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa39' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                }
                template += '</tr>';
                $('#understanding > tbody:last-child').append(template);
            }
            if(oldData != undefined) {
                bindingData();
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
            showPregnancyTable();
            showCancerCard();
        });

        function addFormValidate() {
            jQuery.validator.addMethod("checkOvarian", function (value, element, args) {
                $($(element).data('error')).show();
                var checkValue = $('input[name="' + args[1] + '"]:checked').val();
                if(checkValue == undefined) {
                    return true;
                }
                return value == args[0];
            }, msgReqYes);

            // Submit form input
            $("#anketForm").submit(function(event){
                $(window).scroll(function(event){
                    var bottomHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight - $(".footerInfo").height() - $(".form-group.text-center").height();
                    var st = $(this).scrollTop();
                    if (st < bottomHeight){
                        $(".footerSubmit").removeClass("d-none");
                    } else {
                        $(".footerSubmit").addClass("d-none");
                    }
                });
            });
            
            // Validate form input
            $("#anketForm").validate({
                rules: {
                    doctorName: 'required',
                    gender: 'required',
                    'qa2[year]': {required: true, number: true, min: 1800, max: curYear, maxlength: 4},
                    'qa2[month]': {required: true, number: true, min: 1, max: 12, maxlength: 2},
                    qa3: {required: true, number: true, min: 0},
                    'qa4[height]': {required: true, number: true, min: 1},
                    'qa4[weight]': {required: true, number: true, min: 1},
                    qa5: {required: function() {return checkRequirePoint('qa5');}},
                    // 'qa6a[sel]' : {required: function() {return checkReqDepend('qa6a[sel]', 'qa6a[ml]');}},
                    'qa6a[ml]' : {required: function() {return checkReqDepend('qa6a[sel]', 'qa6a[ml]') || checkReqAlcohol();}, number: true, min: 0},
                    // 'qa6b[sel]' : {required: function() {return checkReqDepend('qa6b[sel]', 'qa6b[ml]');}},
                    'qa6b[ml]' : {required: function() {return checkReqDepend('qa6b[sel]', 'qa6b[ml]');}, number: true, min: 0},
                    // 'qa6c[sel]' : {required: function() {return checkReqDepend('qa6c[sel]', 'qa6c[ml]');}},
                    'qa6c[ml]' : {required: function() {return checkReqDepend('qa6c[sel]', 'qa6c[ml]');}, number: true, min: 0},
                    // 'qa6d[sel]' : {required: function() {return checkReqDepend('qa6d[sel]', 'qa6d[ml]');}},
                    'qa6d[ml]' : {required: function() {return checkReqDepend('qa6d[sel]', 'qa6d[ml]');}, number: true, min: 0},
                    // 'qa6e[sel]' : {required: function() {return checkReqDepend('qa6e[sel]', 'qa6e[ml]');}},
                    'qa6e[ml]' : {required: function() {return checkReqDepend('qa6e[sel]', 'qa6e[ml]');}, number: true, min: 0},
                    // 'qa6f[sel]' : {required: function() {return checkReqDepend('qa6f[sel]', 'qa6f[ml]');}},
                    'qa6f[ml]' : {required: function() {return checkReqDepend('qa6f[sel]', 'qa6f[ml]');}, number: true, min: 0},
                    qa7: {required: function() {return checkRequirePoint('qa7');}},
                    'qa8[ageFrom]': {required: function() {return checkRequire('qa7', '今はやめて吸わない');}, number: true, min: 1},
                    'qa8[ageTo]': {required: function() {return checkRequire('qa7', '今はやめて吸わない');}, number: true, min: 1},
                    'qa8[quantity]': {required: function() {return checkRequire('qa7', '今はやめて吸わない');}, number: true, min: 1},
                    'qa9[age]': {required: function() {return checkRequire('qa7', '吸っている');}, number: true, min: 1},
                    'qa9[quantity]': {required: function() {return checkRequire('qa7', '吸っている');}, number: true, min: 1},
                    qa10: 'required',
                    qa11: {required: function() {return checkRequire('qa10');}},
                    qa11Other: 'required',
                    qa12: 'required',
                    drugDescriptions: {
                        required: '#drugCheck:unchecked',
                    },
                    qa14: 'required',
                    qa15: 'required',
                    qa16: 'required',
                    qa17: 'required',
                    qa18: 'required',
                    'qa19[0][typeOfCancer]': {required: function() { return checkCancerReq('qa18');}},
                    'qa19[0][diagnosisYear]': {required: function() { return checkCancerReq('qa18');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa19[0][diagnosisMonth]': {required: function() { return checkCancerReq('qa18');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa19[0][stateTreatment]': {required: function() { return checkCancerReq('qa18');}},
                    'qa19[0][cancerTreatment]': {required: function() { return checkCancerReq('qa18');}},
                    'qa19[0][cancerTreatmentOther]': {required: function() { return checkOtherTreatment('qa18', 'qa19[0]')}},
                    'qa19[1][typeOfCancer]': {required: function() {return checkCancerAdditional('qa18','#qa19_1', 'qa19[1]');}},
                    'qa19[1][diagnosisYear]': {required: function() {return checkCancerAdditional('qa18','#qa19_1', 'qa19[1]');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa19[1][diagnosisMonth]': {required: function() {return checkCancerAdditional('qa18','#qa19_1', 'qa19[1]');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa19[1][stateTreatment]': {required: function() {return checkCancerAdditional('qa18','#qa19_1', 'qa19[1]');}},
                    'qa19[1][cancerTreatment]': {required: function() {return checkCancerAdditional('qa18','#qa19_1', 'qa19[1]');}},
                    'qa19[1][cancerTreatmentOther]': {required: function() {return checkOtherTreatment('qa18', 'qa19[1]');}},
                    'qa19[2][typeOfCancer]': {required: function() {return checkCancerAdditional('qa18','#qa19_2', 'qa19[2]');}},
                    'qa19[2][diagnosisYear]': {required: function() {return checkCancerAdditional('qa18','#qa19_2', 'qa19[2]');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa19[2][diagnosisMonth]': {required: function() {return checkCancerAdditional('qa18','#qa19_2', 'qa19[2]');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa19[2][stateTreatment]': {required: function() {return checkCancerAdditional('qa18','#qa19_2', 'qa19[2]');}},
                    'qa19[2][cancerTreatment]': {required: function() {return checkCancerAdditional('qa18','#qa19_2', 'qa19[2]');}},
                    'qa19[2][cancerTreatmentOther]': {required: function() {return checkOtherTreatment('qa18', 'qa19[2]');}},
                    'qa19[3][typeOfCancer]': {required: function() {return checkCancerAdditional('qa18','#qa19_3', 'qa19[3]');}},
                    'qa19[3][diagnosisYear]': {required: function() {return checkCancerAdditional('qa18','#qa19_3', 'qa19[3]');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa19[3][diagnosisMonth]': {required: function() {return checkCancerAdditional('qa18','#qa19_3', 'qa19[3]');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa19[3][stateTreatment]': {required: function() {return checkCancerAdditional('qa18','#qa19_3', 'qa19[3]');}},
                    'qa19[3][cancerTreatment]': {required: function() {return checkCancerAdditional('qa18','#qa19_3', 'qa19[3]');}},
                    'qa19[3][cancerTreatmentOther]': {required: function() {return checkOtherTreatment('qa18', 'qa19[3]');}},
                    'diagnosedDiseases': {required: function() {return checkRequireDisease('diagnosedDiseases', 'disease', '#diagnosedDiseasesError');}},
                    'diagnosedInfection': {required: function() {return checkRequireDisease('diagnosedInfection', 'infection', '#diagnosedInfectionError');}},
                    'infectionPneumoniaAge': {required: function() {return checkReqDepend('infectionPneumonia', 'infectionPneumoniaAge');}, number: true, min: 0},
                    'infectionSepsisAge': {required: function() {return checkReqDepend('infectionSepsis', 'infectionSepsisAge');}, number: true, min: 0},
                    'infectionArthritisAge': {required: function() {return checkReqDepend('infectionArthritis', 'infectionArthritisAge');}, number: true, min: 0},
                    'infectionPyelonephritisAge': {required: function() {return checkReqDepend('infectionPyelonephritis', 'infectionPyelonephritisAge');}, number: true, min: 0},
                    'infectionOsteomyelitisAge': {required: function() {return checkReqDepend('infectionOsteomyelitis', 'infectionOsteomyelitisAge');}, number: true, min: 0},
                    'infectionHerpesZosterAge': {required: function() {return checkReqDepend('infectionHerpesZoster', 'infectionHerpesZosterAge');}, number: true, min: 0},
                    'infectionPeritonitisAge': {required: function() {return checkReqDepend('infectionPeritonitis', 'infectionPeritonitisAge');}, number: true, min: 0},
                    'infectionPeritonitisAge': {required: function() {return checkReqDepend('infectionPeritonitis', 'infectionPeritonitisAge');}, number: true, min: 0},
                    'infectionOther1Age': {required: function() {return checkOtherInfects('infectionOther1Name');}, number: true, min: 0},
                    'infectionOther1Name': {required: function() {return checkOtherInfects('infectionOther1Age');}},
                    'infectionOther2Age': {required: function() {return checkOtherInfects('infectionOther2Name');}, number: true, min: 0},
                    'infectionOther2Name': {required: function() {return checkOtherInfects('infectionOther2Age');}},
                    'infectionOther3Age': {required: function() {return checkOtherInfects('infectionOther3Name');}, number: true, min: 0},
                    'infectionOther3Name': {required: function() {return checkOtherInfects('infectionOther3Age');}},
                    'qa22[ovarianDiagnosed]': {required: function() {return checkRequireChoose('#gender', femalevalue);}, checkOvarian: [yValue, 'qa22[ageAbove40]']},
                    'qa22[ageAbove40]': {required: function() {return (checkRequireSelect('#ovarianDiagnosedY') && checkRequireChoose('#gender', femalevalue));}},
                    qa23: {required: function() {return checkRequireChoose('#gender', femalevalue);}},
                    qa24: {required: function() {return checkRequire('qa23');},number: true,min: 0},
                    'qa25[0][age]': {required: function() {return checkPregnanceReq('qa23');},number: true,min: 0},
                    'qa25[0][year]': {required: function() {return checkPregnanceReq('qa23');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa25[0][month]': {required: function() {return checkPregnanceReq('qa23');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa25[0][day]': {required: function() {return checkPregnanceReq('qa23');},number: true,min: 1,max: 31,maxlength: 2},
                    'qa25[0][pregnancyWeek]': {required: function() {return checkPregnanceReq('qa23');},number: true,min: 0,},
                    'qa25[0][pregnancyStatus]': {required: function() {return checkPregnanceReq('qa23');}},
                    'qa25[0][miscarriageNatural]': {required: function() {return checkRequire('qa25[0][pregnancyStatus]', '2');}},
                    'qa25[0][liveBirthPreterm]': {required: function() {return checkRequire('qa25[0][pregnancyStatus]', '5');}},
                    'qa25[1][age]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_1', 'qa25[1]');},number: true,min: 0},
                    'qa25[1][year]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_1', 'qa25[1]');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa25[1][month]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_1', 'qa25[1]');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa25[1][day]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_1', 'qa25[1]');},number: true,min: 1,max: 31,maxlength: 2},
                    'qa25[1][pregnancyWeek]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_1', 'qa25[1]');},number: true,min: 0,},
                    'qa25[1][pregnancyStatus]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_1', 'qa25[1]');}},
                    'qa25[1][miscarriageNatural]': {required: function() {return checkRequire('qa25[1][pregnancyStatus]', '2');}},
                    'qa25[1][liveBirthPreterm]': {required: function() {return checkRequire('qa25[1][pregnancyStatus]', '5');}},
                    'qa25[2][age]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_2', 'qa25[2]');},number: true,min: 0},
                    'qa25[2][year]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_2', 'qa25[2]');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa25[2][month]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_2', 'qa25[2]');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa25[2][day]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_2', 'qa25[2]');},number: true,min: 1,max: 31,maxlength: 2},
                    'qa25[2][pregnancyWeek]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_2', 'qa25[2]');},number: true,min: 0,},
                    'qa25[2][pregnancyStatus]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_2', 'qa25[2]');}},
                    'qa25[2][miscarriageNatural]': {required: function() {return checkRequire('qa25[2][pregnancyStatus]', '2');}},
                    'qa25[2][liveBirthPreterm]': {required: function() {return checkRequire('qa25[2][pregnancyStatus]', '5');}},
                    'qa25[3][age]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_3', 'qa25[3]');},number: true,min: 0},
                    'qa25[3][year]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_3', 'qa25[3]');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa25[3][month]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_3', 'qa25[3]');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa25[3][day]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_3', 'qa25[3]');},number: true,min: 1,max: 31,maxlength: 2},
                    'qa25[3][pregnancyWeek]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_3', 'qa25[3]');},number: true,min: 0,},
                    'qa25[3][pregnancyStatus]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_3', 'qa25[3]');}},
                    'qa25[3][miscarriageNatural]': {required: function() {return checkRequire('qa25[3][pregnancyStatus]', '2');}},
                    'qa25[3][liveBirthPreterm]': {required: function() {return checkRequire('qa25[3][pregnancyStatus]', '5');}},
                    'qa25[4][age]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_4', 'qa25[4]');},number: true,min: 0},
                    'qa25[4][year]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_4', 'qa25[4]');},number: true,min: 1800,max: curYear,maxlength: 4},
                    'qa25[4][month]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_4', 'qa25[4]');},number: true,min: 1,max: 12,maxlength: 2},
                    'qa25[4][day]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_4', 'qa25[4]');},number: true,min: 1,max: 31,maxlength: 2},
                    'qa25[4][pregnancyWeek]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_4', 'qa25[4]');},number: true,min: 0,},
                    'qa25[4][pregnancyStatus]': {required: function() {return checkPregnanceAdditional('qa23', '#qa25_4', 'qa25[4]');}},
                    'qa25[4][miscarriageNatural]': {required: function() {return checkRequire('qa25[4][pregnancyStatus]', '2');}},
                    'qa25[4][liveBirthPreterm]': {required: function() {return checkRequire('qa25[4][pregnancyStatus]', '5');}},
                    qa26: 'required',
                    qa26Other: 'required',
                    qa27: {required: true, number: true, min: 1},
                    qa28: 'required',
                    // qa29: 'required',
                    qa30: 'required',
                    qa31: 'required',
                    qa32: 'required',
                    qa33: {required: function() {return checkRequire('qa32');},number: true,min: 0},
                    qa34: {required: function() {return checkRequire('qa32');},number: true,min: 0},
                    qa35: 'required',
                    qa36: 'required',
                    qa37: {required: function() {return checkRequire('qa36');}},
                    qa38: {required: function() {return checkRequirePoint('qa38');}},
                    'qa39[0][understand]': 'required',
                    'qa39[1][understand]': 'required',
                    'qa39[2][understand]': 'required',
                    'qa39[3][understand]': 'required',
                    'qa39[4][understand]': 'required',
                    'qa39[5][understand]': 'required',
                    'qa39[6][understand]': 'required',
                    'qa39[7][understand]': 'required',
                    'qa39[8][understand]': 'required',
                    'qa39[9][understand]': 'required',
                    'qa39[10][understand]': 'required',
                    'qa39[11][understand]': 'required',
                    'qa39[12][understand]': 'required',
                    'qa39[13][understand]': 'required',
                    'qa39[14][understand]': 'required',
                    'qa39[15][understand]': 'required',
                    'qa39[16][understand]': 'required',
                    'qa39[17][understand]': 'required',
                    'qa39[18][understand]': 'required',
                    'qa39[19][understand]': 'required',
                    'qa39[20][understand]': 'required',
                    'qa39[21][understand]': 'required',
                    'qa39[22][understand]': 'required',
                    'qa39[23][understand]': 'required',
                    'qa39[24][understand]': 'required',
                    'qa39[25][understand]': 'required',
                    'lpusqaA[0][val]': 'required',
                    'lpusqaA[1][val]': 'required',
                    'lpusqaA[2][val]': 'required',
                    'lpusqaA[3][val]': 'required',
                    'lpusqaA[4][val]': 'required',
                    'lpusqaA[5][val]': 'required',
                    'lpusqaA[6][val]': 'required',
                    'lpusqaA[7][val]': 'required',
                    'lpusqaA[8][val]': 'required',
                    'lpusqaB[0][val]': 'required',
                    'lpusqaB[1][val]': 'required',
                    'lpusqaB[2][val]': 'required',
                    'lpusqaB[3][val]': 'required',
                    'lpusqaB[4][val]': 'required',
                    'lpusqaC[0][val]': 'required',
                    'lpusqaC[1][val]': 'required',
                    'lpusqaC[2][val]': 'required',
                    'lpusqaC[3][val]': 'required',
                    'lpusqaC[4][val]': 'required',
                    'lpusqaD[0][val]': 'required',
                    'lpusqaD[1][val]': 'required',
                    'lpusqaD[2][val]': 'required',
                    'lpusqaD[3][val]': 'required',
                    'lpusqaD[4][val]': 'required',
                    'lpusqaD[5][val]': 'required',
                    'lpusqaE[0][val]': 'required',
                    'lpusqaE[1][val]': 'required',
                    'lpusqaE[2][val]': 'required',
                    'lpusqaE[3][val]': 'required',
                    'lpusqaE[4][val]': 'required',
                    'lpusqaF[0][val]': 'required',
                    'lpusqaF[1][val]': 'required',
                    'lpusqaF[2][val]': 'required',
                    'lpusqaF[3][val]': 'required',
                    'lpusqaG[0][val]': 'required',
                    'lpusqaG[1][val]': 'required',
                    'lpusqaG[2][val]': 'required',
                    'lpusqaG[3][val]': 'required',
                    'lpusqaG[4][val]': 'required',
                    'lpusqaH[0][val]': 'required',
                    'lpusqaH[1][val]': 'required',
                    'lpusqaH[2][val]': 'required',
                    'lpusqaH[3][val]': 'required',
                    sf12qa1: 'required',
                    'sf12qa2[0][val]': 'required',
                    'sf12qa2[1][val]': 'required',
                    'sf12qa3[0][val]': 'required',
                    'sf12qa3[1][val]': 'required',
                    'sf12qa4[0][val]': 'required',
                    'sf12qa4[1][val]': 'required',
                    sf12qa5: 'required',
                    'sf12qa6[0][val]': 'required',
                    'sf12qa6[1][val]': 'required',
                    'sf12qa6[2][val]': 'required',
                    sf12qa7: 'required',
                },
                messages: {
                    gender: '性別を選択してください。',
                    'qa2[year]': {required: '年' + msgReqInput, number: msgNumber, min: msgCancerYearMin, max: msgCancerYearMax, maxlength: msgCancerYearLength},
                    'qa2[month]': {required: '月' + msgReqInput, number: msgNumber, min: msgCancerMonthMin, max: msgCancerMonthMax, maxlength: msgCancerMonthLength},
                    qa3: {required: '年齢' + msgReqInput, number: msgNumber, min: msgNumberMin},
                    'qa4[height]': {required: '身長' + msgReqInput, number: msgNumber, min: msgCancerMonthMin},
                    'qa4[weight]': {required: '体重' + msgReqInput, number: msgNumber, min: msgCancerMonthMin},
                    qa5: msgReqCheck,
                    'qa6a[sel]': msgReqCheck,
                    'qa6a[ml]': {required: msgReqNumber, number: msgNumber, min: msgNumberMin},
                    'qa6b[sel]': msgReqCheck,
                    'qa6b[ml]': {required: msgReqNumber, number: msgNumber, min: msgNumberMin},
                    'qa6c[sel]': msgReqCheck,
                    'qa6c[ml]': {required: msgReqNumber, number: msgNumber, min: msgNumberMin},
                    'qa6d[sel]': msgReqCheck,
                    'qa6d[ml]': {required: msgReqNumber, number: msgNumber, min: msgNumberMin},
                    'qa6e[sel]': msgReqCheck,
                    'qa6e[ml]': {required: msgReqNumber, number: msgNumber, min: msgNumberMin},
                    'qa6f[sel]': msgReqCheck,
                    'qa6f[ml]': {required: msgReqNumber, number: msgNumber, min: msgNumberMin},
                    qa7: msgReqCheck,
                    'qa8[ageFrom]': {required: msgReqAge, number: msgNumber, min: msgCancerMonthMin},
                    'qa8[ageTo]': {required: '歳まで' + msgReqInput, number: msgNumber, min: msgCancerMonthMin},
                    'qa8[quantity]': {required: '１日平均本' + msgReqInput, number: msgNumber, min: msgCancerMonthMin},
                    'qa9[age]': {required: '歳から現在まで' + msgReqInput, number: msgNumber, min: msgCancerMonthMin},
                    'qa9[quantity]': {required: '１日平均本' + msgReqInput, number: msgNumber, min: msgCancerMonthMin},
                    qa10: msgYN,
                    qa11: '「SLE」とか「その他」' + msgReqSelect,
                    qa11Other: '病名' + msgReqInput,
                    qa12: msgYN,
                    drugDescriptions: '処方されている「薬の名前」を記載してください。',
                    qa14: msgYN,
                    qa15: msgYN,
                    qa16: msgYN,
                    qa17: msgYN,
                    qa18: msgYN,
                    'qa19[0][typeOfCancer]': '１８）で「はい」とこたえた方はその詳細をおこたえください。',
                    'qa19[0][diagnosisYear]': {required: msgCancerYear,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa19[0][diagnosisMonth]': {required: msgCancerMonth,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa19[0][stateTreatment]': msgCancerStatement,
                    'qa19[0][cancerTreatment]': msgCancerTreatement,
                    'qa19[0][cancerTreatmentOther]': msgCancerTreatementOther,
                    'qa19[1][typeOfCancer]': msgCancerRequire,
                    'qa19[1][diagnosisYear]': {required: msgCancerYear,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa19[1][diagnosisMonth]': {required: msgCancerMonth,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa19[1][stateTreatment]': msgCancerStatement,
                    'qa19[1][cancerTreatment]': msgCancerTreatement,
                    'qa19[1][cancerTreatmentOther]': msgCancerTreatementOther,
                    'qa19[2][typeOfCancer]': msgCancerRequire,
                    'qa19[2][diagnosisYear]': {required: msgCancerYear,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa19[2][diagnosisMonth]': {required: msgCancerMonth,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa19[2][stateTreatment]': msgCancerStatement,
                    'qa19[2][cancerTreatment]': msgCancerTreatement,
                    'qa19[2][cancerTreatmentOther]': msgCancerTreatementOther,
                    'qa19[3][typeOfCancer]': msgCancerRequire,
                    'qa19[3][diagnosisYear]': {required: msgCancerYear,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa19[3][diagnosisMonth]': {required: msgCancerMonth,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa19[3][stateTreatment]': msgCancerStatement,
                    'qa19[3][cancerTreatment]': msgCancerTreatement,
                    'qa19[3][cancerTreatmentOther]': msgCancerTreatementOther,
                    'diagnosedDiseases': '病気・受けた治療' + msgReqInput,
                    'diagnosedInfection': '治療した感染症' + msgReqInput,
                    'infectionPneumoniaAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionSepsisAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionArthritisAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionPyelonephritisAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionOsteomyelitisAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionHerpesZosterAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionPeritonitisAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionPeritonitisAge': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionOther1Age': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionOther1Name': msgReqOtherInfection,
                    'infectionOther2Age': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionOther2Name': msgReqOtherInfection,
                    'infectionOther3Age': {required: msgReqAge,number: msgNumber,min: msgNumberMin},
                    'infectionOther3Name': msgReqOtherInfection,
                    'qa22[ovarianDiagnosed]': {required: msgYN},
                    'qa22[ageAbove40]': msgReqCheck,
                    qa23: msgYN,
                    qa24: {required: msgRequiredPregnance,number: msgNumber,min: msgNumberMin},
                    'qa25[0][age]': {required: msgReqNumber,number: msgNumber,min: msgNumberMin},
                    'qa25[0][year]': {required: msgReqNumber,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa25[0][month]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa25[0][day]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerDayMax,maxlength: msgCancerMonthLength},
                    'qa25[0][pregnancyWeek]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax},
                    'qa25[0][pregnancyStatus]' : {required: msgPregnanceStatus,},
                    'qa25[0][miscarriageNatural]': {required: msgPregnanceMiscarriage},
                    'qa25[0][liveBirthPreterm]': {required: msgPregnancePreterm},
                    'qa25[1][age]': {required: msgReqNumber,number: msgNumber,min: msgNumberMin},
                    'qa25[1][year]': {required: msgReqNumber,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa25[1][month]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa25[1][day]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerDayMax,maxlength: msgCancerMonthLength},
                    'qa25[1][pregnancyWeek]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax},
                    'qa25[1][pregnancyStatus]' : {required: msgPregnanceStatus,},
                    'qa25[1][miscarriageNatural]': {required: msgPregnanceMiscarriage},
                    'qa25[1][liveBirthPreterm]': {required: msgPregnancePreterm},
                    'qa25[2][age]': {required: msgReqNumber,number: msgNumber,min: msgNumberMin},
                    'qa25[2][year]': {required: msgReqNumber,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa25[2][month]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa25[2][day]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerDayMax,maxlength: msgCancerMonthLength},
                    'qa25[2][pregnancyWeek]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax},
                    'qa25[2][pregnancyStatus]' : {required: msgPregnanceStatus,},
                    'qa25[2][miscarriageNatural]': {required: msgPregnanceMiscarriage},
                    'qa25[2][liveBirthPreterm]': {required: msgPregnancePreterm},
                    'qa25[3][age]': {required: msgReqNumber,number: msgNumber,min: msgNumberMin},
                    'qa25[3][year]': {required: msgReqNumber,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa25[3][month]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa25[3][day]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerDayMax,maxlength: msgCancerMonthLength},
                    'qa25[3][pregnancyWeek]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax},
                    'qa25[3][pregnancyStatus]' : {required: msgPregnanceStatus,},
                    'qa25[3][miscarriageNatural]': {required: msgPregnanceMiscarriage},
                    'qa25[3][liveBirthPreterm]': {required: msgPregnancePreterm},
                    'qa25[4][age]': {required: msgReqNumber,number: msgNumber,min: msgNumberMin},
                    'qa25[4][year]': {required: msgReqNumber,number: msgNumber,min: msgCancerYearMin,max: msgCancerYearMax,maxlength: msgCancerYearLength},
                    'qa25[4][month]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax,maxlength: msgCancerMonthLength},
                    'qa25[4][day]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerDayMax,maxlength: msgCancerMonthLength},
                    'qa25[4][pregnancyWeek]': {required: msgReqNumber,number: msgNumber,min: msgCancerMonthMin,max: msgCancerMonthMax},
                    'qa25[4][pregnancyStatus]' : {required: msgPregnanceStatus,},
                    'qa25[4][miscarriageNatural]': {required: msgPregnanceMiscarriage},
                    'qa25[4][liveBirthPreterm]': {required: msgPregnancePreterm},
                    qa26: '学校教育' + msgReqInput,
                    qa26Other: '学校教育' + msgReqInput,
                    qa27:{required: '世帯人数' + msgReqInput,number: msgNumber,min: msgCancerMonthMin},
                    qa28: '合計収入額' + msgReqInput,
                    // qa29: '婚姻状態' + msgReqInput,
                    qa30: msgYN,
                    qa31: msgYN,
                    qa32: msgYN,
                    qa33: {required: '人数' + msgReqInput,number: msgNumber,min: msgNumberMin},
                    qa34: {required: '回数' + msgReqInput,number: msgNumber,min: msgNumberMin},
                    qa35: '担当する主治医氏名' + msgReqInput,
                    qa36: msgYN,
                    qa37: msgYN,
                    qa38: {required: '点' + msgReqSelect},
                    'qa39[0][understand]': msgReqAnswer,
                    'qa39[1][understand]': msgReqAnswer,
                    'qa39[2][understand]': msgReqAnswer,
                    'qa39[3][understand]': msgReqAnswer,
                    'qa39[4][understand]': msgReqAnswer,
                    'qa39[5][understand]': msgReqAnswer,
                    'qa39[6][understand]': msgReqAnswer,
                    'qa39[7][understand]': msgReqAnswer,
                    'qa39[8][understand]': msgReqAnswer,
                    'qa39[9][understand]': msgReqAnswer,
                    'qa39[10][understand]': msgReqAnswer,
                    'qa39[11][understand]': msgReqAnswer,
                    'qa39[12][understand]': msgReqAnswer,
                    'qa39[13][understand]': msgReqAnswer,
                    'qa39[14][understand]': msgReqAnswer,
                    'qa39[15][understand]': msgReqAnswer,
                    'qa39[16][understand]': msgReqAnswer,
                    'qa39[17][understand]': msgReqAnswer,
                    'qa39[18][understand]': msgReqAnswer,
                    'qa39[19][understand]': msgReqAnswer,
                    'qa39[20][understand]': msgReqAnswer,
                    'qa39[21][understand]': msgReqAnswer,
                    'qa39[22][understand]': msgReqAnswer,
                    'qa39[23][understand]': msgReqAnswer,
                    'qa39[24][understand]': msgReqAnswer,
                    'qa39[25][understand]': msgReqAnswer,
                    'lpusqaA[0][val]': msgReqAnswer,
                    'lpusqaA[1][val]': msgReqAnswer,
                    'lpusqaA[2][val]': msgReqAnswer,
                    'lpusqaA[3][val]': msgReqAnswer,
                    'lpusqaA[4][val]': msgReqAnswer,
                    'lpusqaA[5][val]': msgReqAnswer,
                    'lpusqaA[6][val]': msgReqAnswer,
                    'lpusqaA[7][val]': msgReqAnswer,
                    'lpusqaA[8][val]': msgReqAnswer,
                    'lpusqaB[0][val]': msgReqAnswer,
                    'lpusqaB[1][val]': msgReqAnswer,
                    'lpusqaB[2][val]': msgReqAnswer,
                    'lpusqaB[3][val]': msgReqAnswer,
                    'lpusqaB[4][val]': msgReqAnswer,
                    'lpusqaC[0][val]': msgReqAnswer,
                    'lpusqaC[1][val]': msgReqAnswer,
                    'lpusqaC[2][val]': msgReqAnswer,
                    'lpusqaC[3][val]': msgReqAnswer,
                    'lpusqaC[4][val]': msgReqAnswer,
                    'lpusqaD[0][val]': msgReqAnswer,
                    'lpusqaD[1][val]': msgReqAnswer,
                    'lpusqaD[2][val]': msgReqAnswer,
                    'lpusqaD[3][val]': msgReqAnswer,
                    'lpusqaD[4][val]': msgReqAnswer,
                    'lpusqaD[5][val]': msgReqAnswer,
                    'lpusqaE[0][val]': msgReqAnswer,
                    'lpusqaE[1][val]': msgReqAnswer,
                    'lpusqaE[2][val]': msgReqAnswer,
                    'lpusqaE[3][val]': msgReqAnswer,
                    'lpusqaE[4][val]': msgReqAnswer,
                    'lpusqaF[0][val]': msgReqAnswer,
                    'lpusqaF[1][val]': msgReqAnswer,
                    'lpusqaF[2][val]': msgReqAnswer,
                    'lpusqaF[3][val]': msgReqAnswer,
                    'lpusqaG[0][val]': msgReqAnswer,
                    'lpusqaG[1][val]': msgReqAnswer,
                    'lpusqaG[2][val]': msgReqAnswer,
                    'lpusqaG[3][val]': msgReqAnswer,
                    'lpusqaG[4][val]': msgReqAnswer,
                    'lpusqaH[0][val]': msgReqAnswer,
                    'lpusqaH[1][val]': msgReqAnswer,
                    'lpusqaH[2][val]': msgReqAnswer,
                    'lpusqaH[3][val]': msgReqAnswer,
                    sf12qa1: msgReqCheck,
                    'sf12qa2[0][val]': msgReqAnswer,
                    'sf12qa2[1][val]': msgReqAnswer,
                    'sf12qa3[0][val]': msgReqAnswer,
                    'sf12qa3[1][val]': msgReqAnswer,
                    'sf12qa4[0][val]': msgReqAnswer,
                    'sf12qa4[1][val]': msgReqAnswer,
                    sf12qa5: msgReqCheck,
                    'sf12qa6[0][val]': msgReqAnswer,
                    'sf12qa6[1][val]': msgReqAnswer,
                    'sf12qa6[2][val]': msgReqAnswer,
                    sf12qa7: msgReqCheck,
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

        function checkPregnanceReq(depend) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            return valDepend != undefined && valDepend == yValue
                && ((checkPregnanceInput('#qa25_1', 'qa25[1]') && checkPregnanceInput('#qa25_2', 'qa25[2]') && checkPregnanceInput('#qa25_3', 'qa25[3]') && checkPregnanceInput('#qa25_4', 'qa25[4]'))
                    || !checkPregnanceInput('#qa25_0', 'qa25[0]'));
        }

        function checkOtherInfects(depend) {
            return $('input[name="' + depend + '"]').val().length > 0;
        }

        function autoCheck(target, selector) {
            if(target.val().length > 0) {
                $('input[name="' + selector +'"]').iCheck('check');
            } else {
                $('input[name="' + selector +'"]').iCheck('uncheck');
            }
        }

        function checkReqAlcohol() {
            return $('input[name="qa6b[ml]"]').val().length == 0
                && $('input[name="qa6c[ml]"]').val().length == 0
                && $('input[name="qa6d[ml]"]').val().length == 0
                && $('input[name="qa6e[ml]"]').val().length == 0
                && $('input[name="qa6f[ml]"]').val().length == 0
                && $('input[name="qa6b[sel]"]:checked').val() == undefined
                && $('input[name="qa6c[sel]"]:checked').val() == undefined
                && $('input[name="qa6d[sel]"]:checked').val() == undefined
                && $('input[name="qa6e[sel]"]:checked').val() == undefined
                && $('input[name="qa6f[sel]"]:checked').val() == undefined;
        }

        function checkReqDepend(selectName, inputName) {
            var valSelect = $('input[name="' + selectName + '"]:checked').val();
            var valInput = $('input[name="' + inputName + '"]').val();
            return valSelect != undefined || valInput.length > 0 ;
        }

        function changeButtonGroup(target, idError) {
            if (target.val() == otherValue) {
                $('input[name="' + target.attr('name') + 'Other"]').show();
                $(idError).show();
                $(idError + 'Other').show();
            } else {
                $('input[name="' + target.attr('name') + 'Other"]').hide();
                $(idError).hide();
                $(idError + 'Other').hide();
            }
        }

        function addListeners() {
            $('input').on('ifChecked', function(event){
                var target = $(event.target);
                $(target.data('error')).hide();
                var targetName = target.attr('name');
                var index = targetName.indexOf('pregnancyStatus');
                if(index > -1) {
                    var selector = targetName.substring(0, index);
                    switch(target.val()) {
                        case '1':
                        case '3':
                        case '4':
                            disableIcheckItems(true, selector + 'miscarriageNatural]');
                            disableIcheckItems(true, selector + 'liveBirthPreterm]');
                            break;
                        case '2':
                            disableIcheckItems(false, selector + 'miscarriageNatural]');
                            disableIcheckItems(true, selector + 'liveBirthPreterm');
                            break;
                        case '5':
                            disableIcheckItems(true, selector + 'miscarriageNatural]');
                            disableIcheckItems(false, selector + 'liveBirthPreterm]');
                            break;
                        default:
                            break;
                    }
                }
                index = targetName.indexOf('disease');
                if(index > -1) {
                    // Hidden error require
                    $('#diagnosedDiseasesError').hide()
                }
                index = targetName.indexOf('infection');
                if(index > -1) {
                    // Hidden error require
                    $('#diagnosedInfectionError').hide()
                } else {
                    switch(targetName) {
                        case 'drugCheck':
                            disableDrugDescriptions(true);
                            break;
                        case 'diagnosedDiseases':
                            disableDiseases(true, 'disease');
                            break;
                        case 'diagnosedInfection':
                            disableDiseases(true, 'infection');
                            removeInfectionError();
                            break;
                        case 'qa26':
                            if(target.val() == otherValue) {
                                $('#qa26Other').show();
                                $('#qa26Other-error').show();
                            } else {
                                $('#qa26Other').hide();
                                $('#qa26Other-error').hide();
                            }
                            break;
                        default:
                            break;
                    }
                }
            });
            $('input').on('ifUnchecked', function(event){
                var targetName = $(event.target).attr('name');
                switch(targetName) {
                    case 'drugCheck':
                        disableDrugDescriptions(false, targetName);
                        break;
                    case 'diagnosedDiseases':
                        disableDiseases(false, 'disease');
                        break;
                    case 'diagnosedInfection':
                        disableDiseases(false, 'infection');
                        break;
                    default:
                        break;
                }
            });
        }

        $('input[name=qa38]').on('change', function() {
            $('input[name=qa38]').parents('label').removeClass('active');
            $(this).parents('label').addClass('active');
        });
        function removeInfectionError() {
            $('#infectionPneumoniaAge-error').hide();
            $('#infectionSepsisAge-error').hide();
            $('#infectionArthritisAge-error').hide();
            $('#infectionPyelonephritisAge-error').hide();
            $('#infectionOsteomyelitisAge-error').hide();
            $('#infectionHerpesZosterAge-error').hide();
            $('#infectionPeritonitisAge-error').hide();
            $('#infectionOther1Name-error').hide();
            $('#infectionOther2Name-error').hide();
            $('#infectionOther3Name-error').hide();
            $('#infectionOther1Age-error').hide();
            $('#infectionOther2Age-error').hide();
            $('#infectionOther3Age-error').hide();
        }

        function disableDrugDescriptions(isDisable, targetName) {
            if(isDisable) {
                $('#drugDescriptions').attr('disabled', true).removeClass('error');
                $('#drugDescriptions-error').css('display', 'none');
            } else {
                $('textarea[name="drugDescriptions"]').removeAttr('disabled');
            }
        }

        function checkCancerReq(depend) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            return valDepend != undefined && valDepend == yValue &&
                ((checkCancerInput('#qa19_1', 'qa19[1]') && checkCancerInput('#qa19_2', 'qa19[2]') && checkCancerInput('#qa19_3', 'qa19[3]')) || !checkCancerInput('#qa19_0', 'qa19[0]'));
        }

        function showPregnancyTable() {
            $('.auto-show, .auto-show input[type=text]').on('change', function() {
                var next = parseInt($(this).data('id')) + 1;
                $('.auto-show.auto-' + next).show();
            });
            $('.auto-show').hide();
            $('.auto-show').first().show();
            if (oldData) {
                $(oldData.qa25).each(function(index, item) {
                    if (item.age
                        || item.year
                        || item.month
                        || item.day
                        || item.pregnancyWeek
                        || item.pregnancyStatus
                        || item.liveBirthPreterm
                        || item.syndromeHypertension
                        || item.syndromeUteroRetardation || item.syndromeGestationalDiabetes
                    ) {
                        $('.auto-show.auto-' + (index + 1)).show();
                        $('.auto-show.auto-' + (index)).show();
                    }
                });
            }
            $('.auto-show, .auto-show input').on('ifChanged', function(event){
                var next = parseInt($(this).data('id')) + 1;
                $('.auto-show.auto-' + next).show();
            });
        }

        function showCancerCard() {
            $('.card-show, .card-show input[type=text]').on('change', function() {
                var next = parseInt($(this).data('id')) + 1;
                $('.card-show.card-' + next).show();
            });
            $('.card-show').hide();
            $('.card-show').first().show();

            if (oldData) {
                $(oldData.qa19).each(function(index, item) {
                    if (item.typeOfCancer || item.diagnosisYear || item.diagnosisMonth || item.stateTreatment || item.cancerTreatment || item.cancerTreatmentOther) {
                        $('.card-show.card-' + (index + 1)).show();
                        $('.card-show.card-' + (index)).show();
                    }
                });
            }
        }
    </script>
@endpush
