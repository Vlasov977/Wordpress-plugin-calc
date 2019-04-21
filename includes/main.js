"use strict";

(function ($) {
    $(document).ready(function ($) {
        const $radioTrigger = $('.epc-radio-trigger--js');
        const $radioTriggerLoadCheck = $('.epc-radio-trigger-onload--js');
        const $backfillLayerInput = $( "#epc_sloi_zas" );
        const $areaInput = $( "#epc_ploschat" );
        const $formSubmitBtn = $('.btn-submit-epc--js');



        function isNumber(obj) { return !isNaN(parseFloat(obj)) }

        function checkInputType($input) {
            const value = $input.val();
            if (isNumber(value)){
                $input.removeClass('is-invalid');
                return true;
            }
            $input.addClass('is-invalid');
            return false;
        }

        function checkBackfillLayerRange() {
            const value = $backfillLayerInput.val();
            if (parseInt(value) < 4 || 36 < parseInt(value)){
                $backfillLayerInput.addClass('is-invalid');
                return false;
            }
            $backfillLayerInput.removeClass('is-invalid');
            return true;
        }

        function validateBackfillLayer() {
            let validated = true;
            if(!checkInputType($backfillLayerInput)){
                validated = false;
            }
            else if(!checkBackfillLayerRange()){
                validated = false;
            }
            return validated;
        }

        function validateArea() {
            let validated = true;
            if(!checkInputType($areaInput)){
                validated = false;
            }
            return validated;
        }

        function validationFunction() {
            let validated = true;
            if(!validateBackfillLayer()){
                validated = false;
            }
            else if(!validateArea()){
                validated = false;
            }

            return validated;
        }

        $(document).on("keypress", ".form-epc--js", function(e) {
            if( (e.keyCode === 13) && (validationFunction() === false) ) {
                e.preventDefault();
                console.log('DENIED');
                return false;
            }
        });

        $formSubmitBtn.click(function (e) {
            if (!validationFunction()){
                e.preventDefault();
                console.log('DENIED');
                return false;
            }
        });


        function radioToggle(attr, status) {
            attr = attr.toString();
            status = status.toString();
            if (status === 'true'){
                $('.epc-radio-elem--js[data-elem-id="' + attr + '"][data-elem-status="true"]').show();
                $('.epc-radio-elem--js[data-elem-id="' + attr + '"][data-elem-status="false"]').hide();
            }else {
                $('.epc-radio-elem--js[data-elem-id="' + attr + '"][data-elem-status="true"]').hide();
                $('.epc-radio-elem--js[data-elem-id="' + attr + '"][data-elem-status="false"]').show();
            }
        }

        $radioTrigger.change(function () {
            const attrId = $(this).attr('data-trigger-id');
            const attrStatus = $(this).attr('data-trigger-status');
            if ($(this).is(":checked")) {
                radioToggle(attrId, attrStatus);
            }
        });

        $radioTrigger.each(function () {
            if ($(this).is(":checked")) {
                $(this).change();
            }
        });


        $areaInput.keyup(function() {
            validateArea();
        });

        $backfillLayerInput.keyup(function() {
            const value = $(this).val();
            if (parseInt(value) >= 11){
                $('.ecp-limited--js').hide();
                $('#epc_ukrep_list2').prop('checked', true);
            } else {
                $('.ecp-limited--js').show();
            }

            validateBackfillLayer();
        });

        function pageOnloadCheck() {
            $radioTriggerLoadCheck.each(function () {
                $(this).change();
            });
        }
        pageOnloadCheck();

    });
}(jQuery));
