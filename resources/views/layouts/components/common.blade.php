@push('javascript')
    <script>
        // Global value
        var curYear = new Date().getFullYear();
        var otherValue = 'その他';
        var yValue = 'はい';
        var femalevalue = '女性';

        // Define error message:
        var msgMax = '年以降を入力してください。';
        var msgMin = '年以上を入力してください。';
        var msgNumber = '有効な数値を入力してください。';
        var msgNumberIn = 'の数値を入力してください。';
        var msgReqNumber = '数値を入力してください。';
        var msgReqLengthNumber = '数以内で入力してください。';
        var msgReqInput = 'を入力してください。';
        var msgReqSelect = 'を選択してください。';
        var msgReqCheck = 'チェックをつけてください。';
        var msgReqAnswer = 'この問いにお答えください。';
        var msgYN = '「はい」とか「いいえ」を選択してください。';
        var msgCancerStatement = '治療の状態' + msgReqSelect;
        var msgCancerTreatement = 'がんの治療' + msgReqSelect;
        var msgCancerTreatementOther = 'がんの治療' + msgReqInput;
        var msgCancerMonth = '診断日－月' + msgReqInput;
        var msgCancerMonthMin = '1月～12月を入力してください。';
        var msgCancerMonthMax = '1月～12月を入力してください。';
        var msgCancerDayMin = '1日～31日を入力してください。';
        var msgCancerDayMax = '1日～31日を入力してください。';
        var msgCancerMonthLength = '2' + msgReqLengthNumber;
        var msgCancerYear = '診断日－年' + msgReqInput;
        var msgCancerYearLength = '4' + msgReqLengthNumber;
        var msgCancerYearMin = '1800' + msgMin;
        var msgCancerYearMax = curYear + msgMax;
        var msgCancerRequire = 'がんの種類' + msgReqInput;
        var msgHeadacheMax = '0－10' + msgNumberIn;
        var msgPregnanceStatus = '妊娠状態を入力してください。';
        var msgPregnanceMiscarriage = '早期流産を入力してください。';
        var msgPregnancePreterm = '生児出産を入力してください。';
        var msgRequiredPregnance = 'この1年間で妊娠回数' + msgReqInput;
        var msgNumberMin = '0' + msgMin;
        var msgReqAge = '歳' + msgReqInput;
        var msgReqOtherInfection = 'その他の感染症' + msgReqInput;
        var msgReqYes = 'はいを選んでください。';

        function checkRequireDisease(depend, searchName, idError) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            var result = (valDepend == undefined && !checkDetailDesease(searchName));
            if(result) {
                $(idError).show();
            }
            return result;
        }

        function checkDetailDesease(searchName) {
            var result = false;
            $('input[name*="' + searchName + '"]').each(function() {
                var target = $(this);
                var type = target.attr('type');
                if(type == 'text') {
                    if(target.val().length > 0) {
                        result = true;
                        return true;
                    }
                } else {
                    if(target.is(':checked')) {
                        result = true;
                        return result;
                    }
                }
            });
            return result;
        }

        function changeCancerGroup(target, otherInputId) {
            $(target.data('error')).hide();
            if(target.val() == otherValue) {
                $(otherInputId).show();
                $(otherInputId + '-error').show();
            } else {
                $(otherInputId).hide();
                $(otherInputId + '-error').hide();
            }
        }

        function disableDiseases(isDisable, searchName) {
            $('input[name*="' + searchName + '"]').each(function() {
                var target = $(this);
                var type = target.attr('type');
                if(isDisable) {
                    if(type == 'text') {
                        target.attr('disabled', true);
                        target.removeClass('error');
                    } else {
                        target.iCheck('uncheck').iCheck('disable');
                    }
                } else {
                    if(type == 'text') {
                        target.attr('disabled', false);
                    } else {
                        target.iCheck('enable');
                    }
                }
            });
        }

        function checkCancerAdditional(depend, id, name) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            return valDepend != undefined && valDepend == yValue && !checkCancerInput(id, name);
        }

        function checkCancerInput(controlId, controlName) {
            return $(controlId + 'typeOfCancer').val().length == 0
                && $(controlId + 'diagnosisYear').val().length == 0
                && $(controlId + 'diagnosisMonth').val().length == 0
                && $('input[name="' + controlName + '[stateTreatment]"]:checked').val() == undefined
                && $('input[name="' + controlName + '[cancerTreatment]"]:checked').val() == undefined;
        }

        function checkPregnanceAdditional(depend, id, name) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            return valDepend != undefined && valDepend == yValue && !checkPregnanceInput(id, name);
        }

        function disableIcheckItems(isDisable, selector) {
            if(isDisable) {
                $('input[name="' + selector + '"]').each(function() {
                    var target = $(this);
                    target.iCheck('uncheck').iCheck('disable');
                    $(target.data('error')).hide();
                });
            } else {
                $('input[name="' + selector + '"]').iCheck('enable');
            }
        }

        function checkPregnanceInput(controlId, controlName) {
            return $(controlId + 'age').val().length == 0
                && $(controlId + 'year').val().length == 0
                && $(controlId + 'month').val().length == 0
                && $(controlId + 'day').val().length == 0
                && $(controlId + 'pregnancyWeek').val().length == 0
                && $('input[name="' + controlName + '[pregnancyStatus]"]:checked').val() == undefined
                && $('input[name="' + controlName + '[syndromeHypertension]"]:checked').val() == undefined
                && $('input[name="' + controlName + '[syndromeUteroRetardation]"]:checked').val() == undefined
                && $('input[name="' + controlName + '[syndromeGestationalDiabetes]"]:checked').val() == undefined
        }

        function checkOtherTreatment(depend, name) {
            var valDepend = $('input[name="' + depend + '"]:checked').val();
            var selVal = $('input[name="' + name + '[cancerTreatment]"]:checked').val();
            return valDepend != undefined && valDepend == yValue && selVal != undefined && selVal == otherValue;
        }

        function checkRequire(elName, value) {
            var valDepend = $('input[name="' + elName + '"]:checked').val();
            var valCompare = yValue;
            if(value !== undefined) {
                valCompare = value;
            }
            return valDepend != undefined && valDepend == valCompare;
        }

        function checkRequirePoint(elName) {
            var valDepend = $('input[name="' + elName + '"]:checked').val();
            return valDepend == undefined;
        }

        function checkRequireChoose(elId, value) {
            var valEl = $(elId).val();
            return valEl != undefined && valEl == value;
        }

        function checkRequireSelect(elName) {
            if( $(elName).hasClass('active') ) {
                return true;
            }
            return false;
        }

        function hideError(selector) {
            $(selector).hide();
        }

        function uncheckChildren(target) {
            var name = target.attr('name');
            var list = name.split('[ovarianDiagnosed]');
            if(list.length == 2) {
                var checkedValue = $('input[name="' + name + '"]:checked').val();
                if(checkedValue != yValue) {
                    $('input[name="' + list[0] + '[ageAbove40]"]').each(function() {
                        var radio = $(this);
                        radio.iCheck('uncheck');
                        radio.attr('checked', false);
                    });
                }
            }
        }

        function getData(target) {
            if(target.attr('name') == undefined) {
                return undefined;
            }
            var name = target.attr('name').replace(/\]/g, '');
            var keys = name.split('[');
            var checkVal;
            switch(keys.length) {
                case 1:
                    return oldData[name];
                case 2:
                    checkVal = oldData[keys[0]];
                    return checkVal != undefined? oldData[keys[0]][keys[1]] : undefined;
                case 3:
                    checkVal = oldData[keys[0]];
                    if(checkVal == undefined) {
                        return undefined;
                    }
                    checkVal = oldData[keys[0]][keys[1]];
                    return checkVal != undefined? oldData[keys[0]][keys[1]][keys[2]] : undefined;
                case 4:
                    checkVal = oldData[keys[0]][keys[1]][keys[2]];
                    return checkVal != undefined? oldData[keys[0]][keys[1]][keys[2]][keys[3]] : undefined;
            }
            return undefined;
        }

        function bindingData() {
            $('#gender').val(oldData.gender);
            $('#drugDescriptions').val(oldData.drugDescriptions);
            setInputData();
            setCheckBoxData();
            setToogleData();
            setRadioData();
            setToogleCheckboxData();
        }

        function setInputData() {
            $('input[type="text"]').each(function() {
                var target = $(this);
                target.val(getData(target));
            });
        }

        function setCheckBoxData() {
            $('input[type="checkbox"]').each(function() {
                var target = $(this);
                var value = getData(target);
                var name = target.attr('name');
                if(value == 1) {
                    target.attr('checked', true);
                    switch(name) {
                        case 'drugCheck':
                            $('#drugDescriptions').attr('disabled', true);
                            break;
                        case 'diagnosedDiseases':
                            disableDiseases(value, 'disease');
                            break;
                        case 'diagnosedInfection':
                            disableDiseases(value, 'infection');
                            break;
                    }
                }
            });
        }

        function setToogleData() {
            $('input[type="radio"].no-icheck').each(function(){
                var target = $(this);
                var value = target.val();
                if(value == getData(target)) {
                    target.attr('checked', true).parent().addClass('active');
                    if(value == otherValue) {
                        var name = target.attr('name');
                        if(name.indexOf('cancerTreatment') > -1) {
                            $(target.attr('onchange').split(',')[1].replace(/\)|'/g, '')).show();
                        } else {
                            $('#' + name + 'Other').show();
                        }
                    }
                }
            });
        }

        function setRadioData() {
            $('input[type="radio"]:not(.no-icheck)').each(function() {
                var target = $(this);
                if(target.val() === getData(target)) {
                    var name = target.attr('name');
                    if(name.indexOf('miscarriageNatural') > -1 || name.indexOf('liveBirthPreterm') > -1) {
                        $('input[name="' + name +'"]').each(function() {
                            $(this).attr('disabled', false);
                        });
                    }
                    target.attr('checked', true);
                }
            });
        }

        function checkBeforeSubmit(){
            $('#anketForm').submit(function(event){
                event.preventDefault();
                if($('#anketForm').valid()){
                    $('#modal').modal('show');
                } else {
                    $('input[type="checkbox"].no-icheck').each(function(){
                        $($(this).data('error')).show();
                    });
                }
            });
        }

        function submit() {
            $('#anketForm').submit();
        }

        function setToogleCheckboxData() {
            $('input[type="checkbox"].no-icheck').each(function(){
                var target = $(this);
                var value = target.val();
                if(value == getData(target)) {
                    target.attr('checked', true).parent().addClass('active');
                    if(value == otherValue) {
                        var name = target.attr('name');
                        if(name.indexOf('cancerTreatment') > -1) {
                            $(target.attr('onchange').split(',')[1].replace(/\)|'/g, '')).show();
                        } else {
                            $('#' + name + 'Other').show();
                        }
                    }
                }
            });
        }

        function changeCancerGroupCheckbox(target, otherInputId) {
            $(target.data('error')).hide();
            if ( target[0].checked ) {
                $(otherInputId).show();
                $(otherInputId + '-error').show();
            }else{
                $(otherInputId).hide();
                $(otherInputId + '-error').hide();
            }
        }

        function resetRadio() {
            $('input').on('ifClicked', function(event) {
                var target = $(event.target);
                var name = target.attr('name');
                var checkedValue = $('input[name="' + name + '"]:checked').val();
                var targetValue = target.val();
                if(targetValue ==  checkedValue) {
                    target.iCheck('uncheck');
                    target.attr('checked', false);
                    $(target.data('error')).show();

                    // disable pregnacy status
                    var index = name.indexOf('pregnancyStatus');
                    if(index > -1) {
                        var selector = name.substring(0, index);
                        if(targetValue == '2') {
                            disableIcheckItems(true, selector + 'miscarriageNatural]');
                        } else if(targetValue == '5') {
                            disableIcheckItems(true, selector + 'liveBirthPreterm]');
                        }
                    }
                }
            });
        }

        function changeToogle(target) {
            $('input[name="' + target.attr('name') + '"]').each(function() {
                var input = $(this);
                if(input.val() != target.val()) {
                    input.parent().removeClass('active');
                    input.prop('checked', false);
                }
            });
        }
    </script>
@endpush
