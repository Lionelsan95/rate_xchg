$(document).ready(function (){

    init();

    function update() {
        if( ( $("#transaction_bcurr").val() != $("#transaction_tcurr").val() ) && parseFloat($("#transaction_bamount").val()) > 0.0) {
            var $base = $("#transaction_bcurr").val(), $target = $("#transaction_tcurr").val();
            var $rate, $val = parseFloat($("#transaction_bamount").val());

            $.post("http://127.0.0.1:8000/transaction/getrate/" + $base + "/" + $target).done(function (data) {
                $rate = parseFloat(data);
                $("#transaction_xrate").val(data);
                $("#transaction_tamount").val($rate * $val);
                delspiner();
            });

        }else if( $("#transaction_bcurr").val() == $("#transaction_tcurr").val() ){
            $("#transaction_xrate").val(1);
            $("#transaction_tamount").val($("#transaction_bamount").val());
            delspiner();
        }
    }

    // This method add loader besides the fields Target amount and exchange rate
    function addspiner(){
        var spiner = '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>';

        $('#transaction_xrate').parent().children('div.spinner-border.text-primary').remove();
        $('#transaction_tamount').parent().children('div.spinner-border.text-primary').remove();

        $('#transaction_xrate').parent().append(spiner);
        $('#transaction_tamount').parent().append(spiner);
    }

    // This method remove loader besides the fields Target amount and exchange rate
    function delspiner(){
        $('#transaction_tamount').parent().children('div.spinner-border.text-primary').remove();
        $('#transaction_xrate').parent().children('div.spinner-border.text-primary').remove();
    }

    function init(){
        $('#transaction_save').on('click', function(){
            $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\nLoading...');
        });

        $("#transaction div").attr('class', 'form-group');
        $("#transaction input, #transaction select").attr('class', 'form-control');

        $("#transaction_tcurr, #transaction_bcurr, #transaction_bamount ").on('change', function(){
            addspiner();
            update();
        });

        $("#transaction_bamount ").on('keyup', function(){
            addspiner();
            update();
        });
    }

});