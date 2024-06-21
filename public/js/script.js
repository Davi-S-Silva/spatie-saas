$(function () {

    $('.btn-add').click(function () {
        alert('add novo numero contato')
        return false;
    });
    $('.link-add-colaborador-entrega').click(function () {
        $('#Clone_Append_Colaborador').clone(true).appendTo('.append-colaborador-entrega').removeAttr('id');
        return false;
    });

    $('.remove_select_colaborador').click(function(){
        $.each($('.append-colaborador-entrega'), function(key, val){
            var qtdFilhos = $('.colaborador-entrega').find('.colaborador').length;
            if(qtdFilhos==1){
                $('.colaborador-entrega').attr('id','Clone_Append_Colaborador')
            }else{
                $('.remove_select_colaborador').parents().eq(2).remove();
            }
            // console.log(qtdFilhos)
        })

        return false;
    });


});
