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
            var data = oldData == undefined? JSON.parse(jsonData).understanding : oldData.qa26;
            for(var i=0; i<data.length; i++) {
                var template = '<tr>'
                    + '<td class="d-none d-md-table-cell align-middle">' + data[i].no + '</td>'
                    + '<td class="title-question"><span class="d-inline d-md-none">'+ data[i].no +'</span>' + data[i].name
                    + '<div id="understand_' + i +'Error"></div>'
                    + '<input type="hidden" value="' + data[i].no + '" name="qa26[' + i + '][no]">'
                    + '<input type="hidden" value="' + data[i].name + '" name="qa26[' + i + '][name]">'
                    + '</td>';
                switch(data[i].understand) {
                    case '1':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '1" checked value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '2':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '2" checked value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '3':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" checked value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '4':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '4" checked value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    case '5':
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '5" checked value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
                        break;
                    default:
                        template += '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '1" value="1" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '1\').iCheck(\'toggle\');"> まったくあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '2" value="2" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '2\').iCheck(\'toggle\');"> どちらかといえばあてはまらない</span>'+'</td>'
                            // + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" value="3" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline"> どちらかといえばあてはまらない</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '4" value="4" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '4\').iCheck(\'toggle\');"> ややあてはまる</span>'+'</td>'
                            + '<td class="text-md-center align-middle"><input type="radio" class="form-check-input" name="qa26[' + i + '][understand]" id="qa26' + i + '5" value="5" data-error="#understand_' + i + 'Error"><span class="d-md-none d-inline" onclick="$(\'#qa26' + i + '5\').iCheck(\'toggle\');"> たいへんよくあてはまる</span>'+'</td>'
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
                    drugDescriptions: {
                        required: '#drugCheck:unchecked',
                    },
                    qa2: 'required',
                    qa3: 'required',
                    qa4: 'required',
                    qa5: 'required',
                    qa6: 'required',
                    'qa7[0][typeOfCancer]': {
                        required: function() {
                            return checkCancerReq('qa6');
                        }
                    },
                    'qa7[0][diagnosisYear]': {
                        required: function() {
                            return checkCancerReq('qa6');
                        },
                        number: true,
                        min: 1800,
                        max: curYear,
                        maxlength: 4
                    },
                    'qa7[0][diagnosisMonth]': {
                        required: function() {
                            return checkCancerReq('qa6');
                        },
                        number: true,
                        min: 1,
                        max: 12,
                        maxlength: 2
                    },
                    'qa7[0][stateTreatment]': {
                        required: function() {
                            return checkCancerReq('qa6');
                        }
                    },
                    'qa7[0][cancerTreatment]': {
                        required: function() {
                            return checkCancerReq('qa6');
                        }
                    },
                    'qa7[0][cancerTreatmentOther]': {
                        required: function() {
                            return checkOtherTreatment('qa6', 'qa7[0]')
                        }
                    },
                    'qa7[1][typeOfCancer]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_1', 'qa7[1]');
                        }
                    },
                    'qa7[1][diagnosisYear]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_1', 'qa7[1]');
                        },
                        number: true,
                        min: 1800,
                        max: curYear,
                        maxlength: 4
                    },
                    'qa7[1][diagnosisMonth]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_1', 'qa7[1]');
                        },
                        number: true,
                        min: 1,
                        max: 12,
                        maxlength: 2
                    },
                    'qa7[1][stateTreatment]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_1', 'qa7[1]');
                        }
                    },
                    'qa7[1][cancerTreatment]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_1', 'qa7[1]');
                        }
                    },
                    'qa7[1][cancerTreatmentOther]': {
                        required: function() {
                            return checkOtherTreatment('qa6', 'qa7[1]');
                        }
                    },
                    'qa7[2][typeOfCancer]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_2', 'qa7[2]');
                        }
                    },
                    'qa7[2][diagnosisYear]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_2', 'qa7[2]');
                        },
                        number: true,
                        min: 1800,
                        max: curYear,
                        maxlength: 4
                    },
                    'qa7[2][diagnosisMonth]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_2', 'qa7[2]');
                        },
                        number: true,
                        min: 1,
                        max: 12,
                        maxlength: 2
                    },
                    'qa7[2][stateTreatment]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_2', 'qa7[2]');
                        }
                    },
                    'qa7[2][cancerTreatment]': {
                        required: function() {
                            return checkCancerAdditional('qa6','#qa7_2', 'qa7[2]');
                        }
                    },
                    'qa7[2][cancerTreatmentOther]': {
                        required: function() {
                            return checkOtherTreatment('qa6', 'qa7[2]');
                        }
                    },
                    'diagnosedDiseases': {
                        required: function() {
                            return checkRequireDisease('diagnosedDiseases', 'disease', '#diagnosedDiseasesError');
                        }
                    },
                    qa9: 'required',
                    'qa10[item1]': {
                        required: function() {
                            return checkRequire('qa9');
                        },
                        number: true,
                        min: 0
                    },
                    'qa10[item2]': {
                        required: function() {
                            return checkRequire('qa9');
                        },
                        number: true,
                        min: 0
                    },
                    'qa10[item3]': {
                        required: function() {
                            return checkRequire('qa9');
                        },
                        number: true,
                        min: 0
                    },
                    'qa10[item4]': {
                        required: function() {
                            return checkRequire('qa9');
                        },
                        number: true,
                        min: 0
                    },
                    'qa10[item5]': {
                        required: function() {
                            return checkRequire('qa9');
                        },
                        number: true,
                        min: 0
                    },
                    'qa10[item6]': {
                        required: function() {
                            return checkRequire('qa9');
                        },
                        number: true,
                        min: 0
                    },
                    'qa10[item7]': {
                        required: function() {
                            return checkRequire('qa9');
                        },
                        number: true,
                        min: 0,
                        max: 10
                    },
                    'qa11[ovarianDiagnosed]': {
                        checkOvarian: [yValue, 'qa11[ageAbove40]']
                    },
                    'qa11[ageAbove40]': {
                        required: function() {
                            return checkRequireSelect('#ovarianDiagnosedY');
                        }
                    },
                    qa13: {
                        required: function() {
                            return checkRequire('qa12');
                        },
                        number: true,
                        min: 0
                    },
                    'qa14[0][age]': {
                        required: function() {
                            return checkPregnanceReq('qa12');
                        },
                        number: true,
                        min: 0
                    },
                    'qa14[0][year]': {
                        required: function() {
                            return checkPregnanceReq('qa12');
                        },
                        number: true,
                        min: 1800,
                        max: curYear,
                        maxlength: 4
                    },
                    'qa14[0][month]': {
                        required: function() {
                            return checkPregnanceReq('qa12');
                        },
                        number: true,
                        min: 1,
                        max: 12,
                        maxlength: 2
                    },
                    'qa14[0][day]': {
                        required: function() {
                            return checkPregnanceReq('qa12');
                        },
                        number: true,
                        min: 1,
                        max: 31,
                        maxlength: 2
                    },
                    'qa14[0][pregnancyWeek]': {
                        required: function() {
                            return checkPregnanceReq('qa12');
                        },
                        number: true,
                        min: 0,
                    },
                    'qa14[0][pregnancyStatus]': {
                        required: function() {
                            return checkPregnanceReq('qa12');
                        }
                    },
                    'qa14[0][miscarriageNatural]': {
                        required: function() {
                            return checkRequire('qa14[0][pregnancyStatus]', '2');
                        }
                    },
                    'qa14[0][liveBirthPreterm]': {
                        required: function() {
                            return checkRequire('qa14[0][pregnancyStatus]', '5');
                        }
                    },
                    'qa14[1][age]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_1', 'qa14[1]');
                        },
                        number: true,
                        min: 0
                    },
                    'qa14[1][year]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_1', 'qa14[1]');
                        },
                        number: true,
                        min: 1800,
                        max: curYear,
                        maxlength: 4
                    },
                    'qa14[1][month]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_1', 'qa14[1]');
                        },
                        number: true,
                        min: 1,
                        max: 12,
                        maxlength: 2
                    },
                    'qa14[1][day]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_1', 'qa14[1]');
                        },
                        number: true,
                        min: 1,
                        max: 31,
                        maxlength: 2
                    },
                    'qa14[1][pregnancyWeek]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_1', 'qa14[1]');
                        },
                        number: true,
                        min: 0,
                    },
                    'qa14[1][pregnancyStatus]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_1', 'qa14[1]');
                        }
                    },
                    'qa14[1][miscarriageNatural]': {
                        required: function() {
                            return checkRequire('qa14[1][pregnancyStatus]', '2');
                        }
                    },
                    'qa14[1][liveBirthPreterm]': {
                        required: function() {
                            return checkRequire('qa14[1][pregnancyStatus]', '5');
                        }
                    },
                    'qa14[2][age]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_2', 'qa14[2]');
                        },
                        number: true,
                        min: 0
                    },
                    'qa14[2][year]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_2', 'qa14[2]');
                        },
                        number: true,
                        min: 1800,
                        max: curYear,
                        maxlength: 4
                    },
                    'qa14[2][month]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_2', 'qa14[2]');
                        },
                        number: true,
                        min: 1,
                        max: 12,
                        maxlength: 2
                    },
                    'qa14[2][day]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_2', 'qa14[2]');
                        },
                        number: true,
                        min: 1,
                        max: 31,
                        maxlength: 2
                    },
                    'qa14[2][pregnancyWeek]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_2', 'qa14[2]');
                        },
                        number: true,
                        min: 0,
                    },
                    'qa14[2][pregnancyStatus]': {
                        required: function() {
                            return checkPregnanceAdditional('qa12', '#qa14_2', 'qa14[2]');
                        }
                    },
                    'qa14[2][miscarriageNatural]': {
                        required: function() {
                            return checkRequire('qa14[2][pregnancyStatus]', '2');
                        }
                    },
                    'qa14[2][liveBirthPreterm]': {
                        required: function() {
                            return checkRequire('qa14[2][pregnancyStatus]', '5');
                        }
                    },
                    qa15: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    // qa16: 'required',
                    qa17: 'required',
                    qa18: 'required',
                    qa19: 'required',
                    qa20: 'required',
                    qa21: {
                        required: function() {
                            return checkRequire('qa20');
                        },
                        number: true,
                        min: 0
                    },
                    qa22: {
                        required: function() {
                            return checkRequire('qa20');
                        },
                        number: true,
                        min: 0
                    },
                    qa23: 'required',
                    qa24: {
                        required: function() {
                            return checkRequire('qa23');
                        }
                    },
                    qa25: {
                        required: function() {
                            return checkRequirePoint('qa25');
                        }
                    },
                    'qa26[0][understand]': 'required',
                    'qa26[1][understand]': 'required',
                    'qa26[2][understand]': 'required',
                    'qa26[3][understand]': 'required',
                    'qa26[4][understand]': 'required',
                    'qa26[5][understand]': 'required',
                    'qa26[6][understand]': 'required',
                    'qa26[7][understand]': 'required',
                    'qa26[8][understand]': 'required',
                    'qa26[9][understand]': 'required',
                    'qa26[10][understand]': 'required',
                    'qa26[11][understand]': 'required',
                    'qa26[12][understand]': 'required',
                    'qa26[13][understand]': 'required',
                    'qa26[14][understand]': 'required',
                    'qa26[15][understand]': 'required',
                    'qa26[16][understand]': 'required',
                    'qa26[17][understand]': 'required',
                    'qa26[18][understand]': 'required',
                    'qa26[19][understand]': 'required',
                    'qa26[20][understand]': 'required',
                    'qa26[21][understand]': 'required',
                    'qa26[22][understand]': 'required',
                    'qa26[23][understand]': 'required',
                    'qa26[24][understand]': 'required',
                    'qa26[25][understand]': 'required',
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
                    drugDescriptions: '処方されている「薬の名前」を記載してください。',
                    qa2: msgYN,
                    qa3: msgYN,
                    qa4: msgYN,
                    qa5: msgYN,
                    qa6: msgYN,
                    'qa7[0][typeOfCancer]': '６）で「はい」とこたえた方はその詳細をおこたえください。',
                    'qa7[0][diagnosisYear]': {
                        required: msgCancerYear,
                        number: msgNumber,
                        min: msgCancerYearMin,
                        max: msgCancerYearMax,
                        maxlength: msgCancerYearLength
                    },
                    'qa7[0][diagnosisMonth]': {
                        required: msgCancerMonth,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa7[0][stateTreatment]': msgCancerStatement,
                    'qa7[0][cancerTreatment]': msgCancerTreatement,
                    'qa7[0][cancerTreatmentOther]': msgCancerTreatementOther,
                    'qa7[1][typeOfCancer]': msgCancerRequire,
                    'qa7[1][diagnosisYear]': {
                        required: msgCancerYear,
                        number: msgNumber,
                        min: msgCancerYearMin,
                        max: msgCancerYearMax,
                        maxlength: msgCancerYearLength
                    },
                    'qa7[1][diagnosisMonth]': {
                        required: msgCancerMonth,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa7[1][stateTreatment]': msgCancerStatement,
                    'qa7[1][cancerTreatment]': msgCancerTreatement,
                    'qa7[1][cancerTreatmentOther]': msgCancerTreatementOther,
                    'qa7[2][typeOfCancer]': msgCancerRequire,
                    'qa7[2][diagnosisYear]': {
                        required: msgCancerYear,
                        number: msgNumber,
                        min: msgCancerYearMin,
                        max: msgCancerYearMax,
                        maxlength: msgCancerYearLength
                    },
                    'qa7[2][diagnosisMonth]': {
                        required: msgCancerMonth,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa7[2][stateTreatment]': msgCancerStatement,
                    'qa7[2][cancerTreatment]': msgCancerTreatement,
                    'qa7[2][cancerTreatmentOther]': msgCancerTreatementOther,
                    'diagnosedDiseases': '病気・受けた治療' + msgReqInput,
                    qa9: msgYN,
                    'qa10[item1]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin,
                    },
                    'qa10[item2]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin,
                    },
                    'qa10[item3]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin,
                    },
                    'qa10[item4]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin,
                    },
                    'qa10[item5]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin,
                    },
                    'qa10[item6]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin,
                    },
                    'qa10[item7]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgHeadacheMax,
                        max: msgHeadacheMax
                    },
                    'qa11[ovarianDiagnosed]': msgReqYes,
                    'qa11[ageAbove40]': msgReqCheck,
                    qa12: msgYN,
                    qa13: {
                        required: msgRequiredPregnance,
                        number: msgNumber,
                        min: msgNumberMin
                    },
                    'qa14[0][age]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin
                    },
                    'qa14[0][year]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerYearMin,
                        max: msgCancerYearMax,
                        maxlength: msgCancerYearLength
                    },
                    'qa14[0][month]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa14[0][day]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerDayMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa14[0][pregnancyWeek]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax
                    },
                    'qa14[0][pregnancyStatus]' : {
                        required: msgPregnanceStatus,
                    },
                    'qa14[0][miscarriageNatural]': {
                        required: msgPregnanceMiscarriage
                    },
                    'qa14[0][liveBirthPreterm]': {
                        required: msgPregnancePreterm
                    },
                    'qa14[1][age]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin
                    },
                    'qa14[1][year]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerYearMin,
                        max: msgCancerYearMax,
                        maxlength: msgCancerYearLength
                    },
                    'qa14[1][month]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa14[1][day]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerDayMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa14[1][pregnancyWeek]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax
                    },
                    'qa14[1][pregnancyStatus]' : {
                        required: msgPregnanceStatus,
                    },
                    'qa14[1][miscarriageNatural]': {
                        required: msgPregnanceMiscarriage
                    },
                    'qa14[1][liveBirthPreterm]': {
                        required: msgPregnancePreterm
                    },
                    'qa14[2][age]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin
                    },
                    'qa14[2][year]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerYearMin,
                        max: msgCancerYearMax,
                        maxlength: msgCancerYearLength
                    },
                    'qa14[2][month]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa14[2][day]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerDayMax,
                        maxlength: msgCancerMonthLength
                    },
                    'qa14[2][pregnancyWeek]': {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgCancerMonthMin,
                        max: msgCancerMonthMax
                    },
                    'qa14[2][pregnancyStatus]' : {
                        required: msgPregnanceStatus,
                    },
                    'qa14[2][miscarriageNatural]': {
                        required: msgPregnanceMiscarriage
                    },
                    'qa14[2][liveBirthPreterm]': {
                        required: msgPregnancePreterm
                    },
                    qa15: {
                        required: msgReqNumber,
                        number: msgNumber,
                        min: msgNumberMin
                    },
                    // qa16: '婚姻状態' + msgReqInput,
                    qa17: msgYN,
                    qa18: msgYN,
                    qa19: '主治医氏名' + msgReqInput,
                    qa20: msgYN,
                    qa21: {
                        required: '人数' + msgReqInput,
                        number: msgNumber,
                        min: msgNumberMin
                    },
                    qa22: {
                        required: '回数' + msgReqInput,
                        number: msgNumber,
                        min: msgNumberMin
                    },
                    qa23: msgYN,
                    qa24: msgYN,
                    qa25: {
                        required: '点' + msgReqSelect,
                    },
                    'qa26[0][understand]': msgReqAnswer,
                    'qa26[1][understand]': msgReqAnswer,
                    'qa26[2][understand]': msgReqAnswer,
                    'qa26[3][understand]': msgReqAnswer,
                    'qa26[4][understand]': msgReqAnswer,
                    'qa26[5][understand]': msgReqAnswer,
                    'qa26[6][understand]': msgReqAnswer,
                    'qa26[7][understand]': msgReqAnswer,
                    'qa26[8][understand]': msgReqAnswer,
                    'qa26[9][understand]': msgReqAnswer,
                    'qa26[10][understand]': msgReqAnswer,
                    'qa26[11][understand]': msgReqAnswer,
                    'qa26[12][understand]': msgReqAnswer,
                    'qa26[13][understand]': msgReqAnswer,
                    'qa26[14][understand]': msgReqAnswer,
                    'qa26[15][understand]': msgReqAnswer,
                    'qa26[16][understand]': msgReqAnswer,
                    'qa26[17][understand]': msgReqAnswer,
                    'qa26[18][understand]': msgReqAnswer,
                    'qa26[19][understand]': msgReqAnswer,
                    'qa26[20][understand]': msgReqAnswer,
                    'qa26[21][understand]': msgReqAnswer,
                    'qa26[22][understand]': msgReqAnswer,
                    'qa26[23][understand]': msgReqAnswer,
                    'qa26[24][understand]': msgReqAnswer,
                    'qa26[25][understand]': msgReqAnswer,
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

        function checkCancerReq(depend) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            return valDepend != undefined && valDepend == yValue &&
                ((checkCancerInput('#qa7_1', 'qa7[1]') && checkCancerInput('#qa7_2', 'qa7[2]')) || !checkCancerInput('#qa7_0', 'qa7[0]'));
        }

        function checkPregnanceReq(depend) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            return valDepend != undefined && valDepend == yValue
                && ((checkPregnanceInput('#qa14_1', 'qa14[1]') && checkPregnanceInput('#qa14_2', 'qa14[2]')) || !checkPregnanceInput('#qa14_0', 'qa14[0]'));
        }

        function addListeners() {
            // Add listener on element
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
                } else {
                    switch(targetName) {
                        case 'drugCheck':
                            disableDrugDescriptions(true);
                            break;
                        case 'diagnosedDiseases':
                            disableDiseases(true, 'disease');
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
                    default:
                        break;
                }
            });
            $('input[name=qa25]').on('change', function() {
                $('input[name=qa25]').parents('label').removeClass('active');
                $(this).parents('label').addClass('active');
            });
        }

        function disableDrugDescriptions(isDisable, targetName) {
            if(isDisable) {
                $('#drugDescriptions').attr('disabled', true).removeClass('error');
                $('#drugDescriptions-error').css('display', 'none');
            } else {
                $('textarea[name="drugDescriptions"]').removeAttr('disabled');
            }
        }

        function showPregnancyTable() {
            $('.auto-show, .auto-show input[type=text]').on('change', function() {
                var next = parseInt($(this).data('id')) + 1;
                $('.auto-show.auto-' + next).show();
            });
            $('.auto-show').hide();
            $('.auto-show').first().show();
            if (oldData) {
                $(oldData.qa14).each(function(index, item) {
                    if (item.age || item.year || item.month
                        || item.day
                        || item.pregnancyWeek
                        || item.pregnancyStatus
                        || item.liveBirthPreterm
                        || item.syndromeHypertension
                        || item.syndromeUteroRetardation
                        || item.syndromeGestationalDiabetes
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
                $(oldData.qa7).each(function(index, item) {
                    if (item.typeOfCancer || item.diagnosisYear || item.diagnosisMonth || item.stateTreatment || item.cancerTreatment || item.cancerTreatmentOther) {
                        $('.card-show.card-' + (index + 1)).show();
                        $('.card-show.card-' + (index)).show();
                    }
                });
            }
        }
    </script>
@endpush
