$(function () {

    var base = 'http://localhost:8080/';
    // var base = 'http://8ebd-177-206-177-236.ngrok-free.app/';

    //====================================
    //      PERMISSIONS
    //====================================
    var routeStorePermission = base + 'permissions';
    var routeCarga = base + 'carga';
    var loading = $('.loading');

    // loading.hide();

    // alert(routeStorePermission)
    $('form[name="formAddPermissao"]').submit(function () {
        // alert($(this).serialize())
        $.ajax({
            url: routeStorePermission,
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                // alert(routeStorePermission)
            },
            success: function (response) {
                // console.log(response)

                if (response.status === 'success') {
                    // alert(response.msg);
                    // $('.response-mesage').html(response.msg)
                    window.location.href=routeStorePermission
                }
                if (response.status === 'danger') {
                    // alert(response.msg);
                    //  $('.response-message').addClass(['alert-danger','d-flex'])
                    // $('.response-message').html(response.msg)
                }
            },
            error: function (response) {
                // alert(response)
                $('.response-message').html(response.msg)
            }
        });

        return false
    });
    $('form[name="formEditPermissao"]').submit(function () {
        // alert($(this).attr('action'))
        $.ajax({
            url: $(this).attr('action'),
            // url: routeStorePermission,
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                // alert(routeStorePermission)
            },
            success: function (response) {
                // alert('success')
                if (response.status === 'success') {
                    // alert(response.msg)
                    $('.response-message').html(response.msg)
                    // console.log(response)
                    window.location.href=routeStorePermission
                }
            },
            error: function (response) {
                // alert('error')
                // console.log(response.msg)
                $('.response-message').html(response.msg)
            }
        });

        return false
    });
    $('form[name="formDeletePermission"]').submit(function () {
        // alert($(this).attr('action'))

        var confirma = confirm('Deseja deletar esta permissao?');

        if (confirma) {
            $.ajax({
                url: $(this).attr('action'),
                // url: routeStorePermission,
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    // alert(routeStorePermission)
                },
                success: function (response) {
                    // alert('success')
                    if (response.status === 'success') {
                        // alert(response.msg)
                        // console.log(response)
                        // $('.response-mesage').removeClass('alert-primary')
                        // $('.response-mesage').addClass('alert-success')
                        window.location.href=routeStorePermission
                    }
                    if (response.status === 'danger') {
                        // alert(response.msg)
                        // console.log(response)
                        $('.response-message').html(response.msg)
                    }
                },
                error: function (response) {
                    // alert('error')
                    // console.log(response.msg)
                    $('.response-message-ajax').addClass('alert-danger').text('erro: '+response.responseJSON.message)
                }
            });
        }
        return false
    });

    //====================================
    //      ROLES
    //====================================

    var routeStoreRole = base + 'roles';
    $('form[name="formAddRole"]').submit(function () {
        // alert($(this).serialize())
        $.ajax({
            url: routeStoreRole,
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                // alert(routeStorePermission)
            },
            success: function (response) {
                // console.log(response)

                if (response.status === 'success') {
                    // alert(response.msg);
                    // $('.response-mesage').html(response.msg)
                    window.location.href=routeStoreRole
                }
                if (response.status === 'danger') {
                    // alert(response.msg);
                     $('.response-message').addClass(['alert-danger','d-flex'])
                    $('.response-message').html(response.msg)
                }
            },
            error: function (response) {
                // alert(response)
                $('.response-message').html(response.msg)
            }
        });

        return false
    });
    $('form[name="formEditRole"]').submit(function () {
        // alert($(this).attr('action'))
        $.ajax({
            url: $(this).attr('action'),
            // url: routeStorePermission,
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                // alert(routeStorePermission)
            },
            success: function (response) {
                // alert('success')
                if (response.status === 'success') {
                    // alert(response.msg)
                    $('.response-message').html(response.msg)
                    // console.log(response)
                    window.location.href=routeStoreRole
                }
            },
            error: function (response) {
                alert('error')
                console.log(response)
                $('.response-message').html(response.msg)
            }
        });

        return false
    });
    $('form[name="formDeleteRole"]').submit(function () {
        // alert($(this).attr('action'))

        var confirma = confirm('Deseja deletar esta role?');

        if (confirma) {
            $.ajax({
                url: $(this).attr('action'),
                // url: routeStorePermission,
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    // alert(routeStorePermission)
                },
                success: function (response) {
                    // alert('success')
                    if (response.status === 'success') {
                        // alert(response.msg)
                        // console.log(response)
                        // $('.response-mesage').removeClass('alert-primary')
                        // $('.response-mesage').addClass('alert-success')
                        window.location.href=routeStoreRole
                    }
                    if (response.status === 'danger') {
                        // alert(response.msg)
                        // console.log(response)
                        $('.response-message').html(response.msg)
                    }
                },
                error: function (response) {
                    // alert('error')
                    $('.response-message-ajax').addClass('alert-danger').text('erro: '+response.responseJSON.message)
                    // console.log(response.responseJSON.message)
                }
            });
        }
        return false
    });


    $('form[name="FormCarregaNotas"]').submit(function(){

        var confirma = confirm('Deseja Carregar Notas?');
        // var confirma = true;
        // var form = $(this)
        // var dados = new FormData(form)
        if (confirma) {
            $.ajax({
                url: $(this).attr('action'),
                // url: routeCarga,
                type: "post",
                // data: $(this).serialize(),
                data: new FormData(this),
                // dataType: 'json',
                // cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // alert(routeStorePermission)
                    loading.css('display','flex')
                    loading.removeClass('d-none');
                    // $("body").css("overflow", "hidden");
                },
                success: function (response) {
                    // alert('success')
                    // console.log(response)
                    loading.addClass('d-none');
                    // $("body").css("overflow", "auto");
                    if (response.status == 200) {
                        // alert(response.msg)
                        // console.log(response)
                        $('.response-message-ajax').removeClass('alert-danger')
                        $('.response-message-ajax').addClass('alert-success')
                        $('.response-message-ajax').text(response.msg)
                        window.location.href=''
                    }
                    if (response.status == 0) {
                        // alert(response.msg)
                        // $('.response-message-ajax').show()
                        // console.log(response)
                        $('.response-message-ajax').removeClass('alert-success')
                        $('.response-message-ajax').addClass('alert-danger')
                        $('.response-message-ajax').html(response.msg)
                    }
                },
                error: function (response) {
                    // alert('error')
                    $('.response-message-ajax').addClass('alert-danger').text('erro: '+response.responseJSON.message)
                    // console.log(response.responseJSON.message)
                }
            });
        }
        return false;
    });

    // FormNovaCarga

    $('form[name="FormNovaCarga"]').submit(function(){

        // var confirma = confirm('Deseja Cadastrar Carga?');
        var confirma = true;

        if (confirma) {
            $.ajax({
                // url: $(this).attr('action'),
                url: routeCarga,
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    // alert(routeStorePermission)
                    // loading.show()

                },
                success: function (response) {
                    // alert('success')


                    console.log(response)

                    if (response.status === 'success') {
                        // alert(response.msg)
                        console.log(response)
                        // $('.response-mesage').removeClass('alert-primary')
                        // $('.response-mesage').addClass('alert-success')
                        // window.location.href=routeStoreRole
                    }
                    if (response.status === 'danger') {
                        // alert(response.msg)
                        // console.log(response)
                        $('.response-message').html(response.msg)
                    }
                },
                error: function (response) {
                    // alert('error')
                    $('.response-message-ajax').addClass('alert-danger').text('erro: '+response.responseJSON.message)
                    // console.log(response.responseJSON.message)
                }
            });
        }
        return false;
    });

    $('form[name="EditCarga"]').submit(function(){

        // console.log($(this).serialize())

        $.ajax({
            url: $(this).attr('action'),
            // url: routeCarga,
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                // alert(routeStorePermission)
                // loading.show()

            },
            success: function (response) {
                // alert('success')


                console.log(response)

                if (response.status === 'success') {
                    // alert(response.msg)
                    console.log(response)
                    // $('.response-mesage').removeClass('alert-primary')
                    // $('.response-mesage').addClass('alert-success')
                    // window.location.href=routeStoreRole
                }
                if (response.status === 'danger') {
                    // alert(response.msg)
                    // console.log(response)
                    $('.response-message').html(response.msg)
                }
            },
            error: function (response) {
                // alert('error')
                $('.response-message-ajax').addClass('alert-danger').text('erro: '+response.responseJSON.message)
                // console.log(response.responseJSON.message)
            }
        });

        return false;
    });

    $('.exclui_nota').click(function(){
        $.ajax({
            type:'get',
            url:'deleta-nota-carregada/'+$(this).attr('href'),
            success:function(response){
                // console.log(response)
                $('.response-message-ajax').addClass('alert-success')
                $('.response-message-ajax').text(response.msg)
                var nota = response.nota;

                console.log(nota)
                $("#nota"+nota).removeClass('d-flex')
                $("#nota"+nota).css('display','none')
                // window.location.href=''
            },
            error:function(response){
                console.log(response)
            }
        })
        return false;
    });

    $('input[name="SelectAll"]').click(function(){

        if($(this).prop("checked")){
            $('input[name="Notas[]"]').prop(
                "checked",true
            )
        }else{
            $('input[name="Notas[]"]').prop(
                "checked",false
            )
        }
        // alert('ola')
    });


    $('form[name="FormExcluirNotas"]').submit(function(){
        // console.log($(this).serialize())


        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            data:$(this).serialize(),
            dataType: 'json',
            beforeSend:function(){

            },
            success:function(response){
                console.log(response)
                $('.response-message-ajax').addClass('alert-success')
                $('.response-message-ajax').text(response.msg)
                var nota = response.nota;
                $("#nota"+nota).removeClass('d-flex')
                $("#nota"+nota).css('display','none')
                window.location.href=''
            },
            error:function(response){
                console.log(response)
            }
        });
        return false;
    });

if($('.form_add_notas').attr('action')==""){
    $('.form_add_notas').hide();
}

    $('.add-notas-carga').click(function(){
        console.log($(this).attr('href'));
        $('.form_add_notas').show();
        $('.form_add_notas').attr('action',$(this).attr('href'))
        $('.form_add_notas legend').text($(this).attr('id'))
        return false;
        });

    $('.form_add_notas').submit(function(){

        console.log($('.form_add_notas').attr('action'))

        $.ajax({
            type:'post',
            url: $('.form_add_notas').attr('action'),
            data:$(this).serialize(),
            dataType: 'json',
            beforeSend:function(){
                console.log($('.form_add_notas').attr('action'))
            },
            success:function(response){
                console.log(response)
            },
            error:function(response){
                console.log(response)
            }
        });

        return false;
    });
    $('.form_add_notas a').click(function(){
        $('.textarea_notas').val('')
        $('.form_add_notas').hide();
        return false;
    });




    $('.link_carga_entrega').click(function(){
        $.ajax({
            type:'get',
            url: $(this).attr('href'),
            // data:
            dataType:'json',
            success(response){
                // console.log(response)
                if(response.status==200){
                    $('.local_cargas_entrega').html('');
                    if($(response.cargas).length!=0){
                        $('.response-message-ajax').show()
                        $('.response-message-ajax').removeClass('alert-danger')
                        $('.response-message-ajax').addClass('alert-success')
                        $('.response-message-ajax').text('Cargas encontradas para o cliente '+response.cliente)
                    }else{
                        $('.response-message-ajax').show()
                        $('.response-message-ajax').addClass('alert-danger')
                        $('.response-message-ajax').removeClass('alert-success')
                        $('.response-message-ajax').text('Cargas não encontradas para o cliente '+response.cliente)
                    }
                    $(response.cargas).each(function(i,e){
                        $('.local_cargas_entrega').append('<div class="d-flex flex-column"><input type="checkbox" id="Carga_'+e.id+'" name="Cargas[]" title="'+e.os+' - '+e.area+' - '+e.motorista+'" value="'+e.id+'"/><label for="Carga_'+e.id+'" class=""><div><b>Motorista: </b> '+
                            e.motorista+'</div><div><b>OS: </b> '+e.os+'</div><div><b>Remessa: </b> '+e.remessa+'</div><div><b>Área: </b>'+e.area+'</div></label></div>');
                    });
                }
                if(response.status==0){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    return false
                }
            },
            error(response){

            }
        });
        return false;
    });

    // $('form[name="FormEntrega"]').submit(function(){
    //     console.log($(this).serialize())
    //     return false;
    // });
    // $('input[name="SemAjudante"]').hide()
    $('form[name="FormEntrega"]').submit(function(){
        // console.log($(this).serialize())
        var Carga = $('input[name="Cargas[]"]')

        if(Carga.length==0){
            // console.log('selecione o cliente')
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('selecione o cliente')
            return false
        }
        var countChecked = 0;
        var textCargas ='Cargas: '
        $(Carga).each(function(i,e){
        //    console.log(e)
           if(e.checked==true){
            countChecked++
            textCargas+= `${e.title} `
           }
        //    console.log('valor: '+ e.value)
        })

        if(Carga.length!= 0 && countChecked<1){
            // alert('selecione a carga')

            $('.response-message-ajax').show().fadeOut(5000)
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Selecione a Carga a ser entregue')
            return false
        }
        // console.log($(this))
        // var ajudante = $('select[name="ajudante[]"]')


        // if(ajudante.length==1){
        //     $(ajudante).each(function(i,e){
        //         alert(e.value)
        //         if(e.value!=''){
        //             // $('#SemAjudante').hide()
        //         }
        //     });
        // }else if(ajudante.length > 1){
        //     $(ajudante).each(function(i,e){
        //         $(e).attr('required')
        //     })
        // }

        var confirma = confirm('Deseja Cadastrar Entrega? '+textCargas +'\n');

        if(confirma){
            $.ajax({
                type:'post',
                url: $(this).attr('action'),
                data:$(this).serialize(),
                dataType: 'json',
                beforeSend:function(){

                },
                success:function(response){
                    // console.log(response)
                    if(response.status==200){
                        $('.response-message-ajax').removeClass('alert-danger')
                        $('.response-message-ajax').addClass('alert-success')
                        $('.response-message-ajax').text(response.msg)
                        $('.response-message-ajax').show()
                    }
                    if(response.status==0)
                        {
                        $('.response-message-ajax').removeClass('alert-success')
                        $('.response-message-ajax').addClass('alert-danger')
                        $('.response-message-ajax').text(response.msg)
                        $('.response-message-ajax').show()
                        return false
                    }
                },
                error:function(response){
                    console.log(response)
                }
            });
        }
        return false;
    })

    $('form[name="FormMovimentacao"]').submit(function(){
        var partida = $('#LocalPartida')
        var destino = $('select[name="LocalDestino"]')
        // alert(partida.value)
        // console.log(partida.val())
        if(partida.val() == ''){
            partida.focus()
            $('.response-message-ajax').show().fadeOut(5000)
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Selecione o local de partida')
            return false
        }else{
            // alert('teste')
            $('.response-message-ajax').hide()
        }
        if(destino.val() == ''){
            destino.focus()
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Selecione o local de destino')
            return false
        }else{
            // alert('teste')
            $('.response-message-ajax').hide()
        }

        if(destino.val()==partida.val()){
            destino.focus()
            $('.response-message-ajax').show().fadeOut(5000)
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('O local de destino nao pode ser igual ao local de partida')
            return false;
        }

        var textDesc = $('textarea[name="DescricaoMov"]')
        if(textDesc.val()==''){
            textDesc.focus()
            $('.response-message-ajax').show().fadeOut(5000)
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Digite uma descricao ou motivo da movimentacao')
            return false
        }

        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            },
            success:function(response){
                if(response.status==200){
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    return false
                }else{
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response)
                    return false;
                }
            },
            error:function(response){
                $('.response-message-ajax').show().fadeOut(5000)
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response)
                return false;
            }
        })
        return false;
    });


    // $('.stop_mov_ajax').hide()

    $('.start_mov').click(function(){
        // alert($(this).attr('href'))
        $('form[name="StartMov"]').show()
        $('form[name="StartMov"]').attr('action',$(this).attr('href'))
        $('form[name="StartMov"] span').text($(this).attr('mov'))
        $('select[name="colaborador"]').val($(this).attr('mot'))
        $('input[name="Mov"]').val($(this).attr('mov'))
        $('form[name="StopMov"]').hide()
        return false
    })

    $('form[name="StartMov"]').submit(function(){
        // alert(
        //     $(this).attr('action')
        // )
        // return false
        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            },
            success:function(response){
                // alert(response)
                console.log(response)
                if(response.status==0){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response)
                }
                if(response.status==200){
                    console.log(response)
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)

                    $('#Start_Mov_'+response.mov.id).hide()
                    $('form[name="StartMov"]').hide()

                    // console.log()
                    $('#Stop_Mov_'+response.mov.id).removeClass('d-none')
                    $('input[name="KmInicial"]').val('')
                }
            },
            error:function(response){
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    })

    $('.stop_mov').click(function(){
        $('form[name="StopMov"]').show()
        $('form[name="StopMov"]').attr('action',$(this).attr('href'))
        $('form[name="StopMov"] span').text($(this).attr('mov'))
        $('input[name="Mov"]').val($(this).attr('mov'))
        // alert($('input[name="Mov"]').val())
        $('form[name="StartMov"]').hide()
        return false
    })


    $('form[name="StopMov"]').submit(function(){
        // alert($('input[name="Mov"]').val())
        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            },
            success:function(response){
                // alert(response)
                // console.log(response)
                if(response.status==0){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if(response.status==200){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)

                    $('#Stop_Mov_'+response.mov.id).hide()
                    $('form[name="StopMov"]').hide()
                    $('input[name="KmFinal"]').val('')
                }
            },
            error:function(response){
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    })


    $('.start_entrega').click(function(){
        $('form[name="StartEntrega"]').show()
        $('form[name="StopEntrega"]').hide()
        $('form[name="StartEntrega"]').attr('action',$(this).attr('href'))
        $('form[name="StartEntrega"] span').text($(this).attr('entrega'))
        $('input[name="Entrega"]').val($(this).attr('Entrega'))
        // // alert($('input[name="Mov"]').val())
        // $('form[name="StartMov"]').hide()
        return false
    })
    $('.stop_entrega').click(function(){
        $('form[name="StartEntrega"]').hide()
        $('form[name="StopEntrega"]').show()
        $('form[name="StopEntrega"]').attr('action',$(this).attr('href'))
        $('form[name="StopEntrega"] span').text($(this).attr('entrega'))
        $('input[name="Entrega"]').val($(this).attr('Entrega'))
        // // alert($('input[name="Mov"]').val())
        // $('form[name="StartMov"]').hide()
        return false
    })
    $('form[name="StartEntrega"]').submit(function(){
        // alert($(this).attr('action'))
        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            },
            success:function(response){
                // alert(response)
                // console.log(response)
                if(response.status==0){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if(response.status==200){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    // $('#Stop_Mov_'+response.mov.id).hide()
                    $('form[name="StopMov"]').hide()
                    $('input[name="KmFinal"]').val('')
                }
            },
            error:function(response){
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    })
    $('form[name="StopEntrega"]').submit(function(){
        // alert($(this).attr('action'))
        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            },
            success:function(response){
                // alert(response)
                // console.log(response)
                if(response.status==0){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if(response.status==200){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    // $('#Stop_Mov_'+response.mov.id).hide()
                    $('form[name="StopMov"]').hide()
                    $('input[name="KmFinal"]').val('')
                }
            },
            error:function(response){
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    })
    var NameProp = $('input[name="NameProp"]')
    var DocProp = $('input[name="DocProp"]')
    NameProp.attr('disabled','disabled')
    DocProp.attr('disabled','disabled')
    $("#LinkNovoProp").click(function(){
        $('#NovoProp').toggle()
        var selectProp=$('#PropVeiculo')


        if(selectProp.attr('disabled')){
            selectProp.removeClass('d-none')
            selectProp.removeAttr('disabled')
            NameProp.attr('disabled','disabled')
            DocProp.attr('disabled','disabled')
        }else{
            selectProp.attr('disabled','disabled')
            selectProp.addClass('d-none')
            DocProp.removeAttr('disabled')
            NameProp.removeAttr('disabled')
            NameProp.toggle()
            DocProp.toggle()

            selectProp.val('')

            // alert(NameProp.val())
            if(NameProp.val()==''){
                NameProp.focus()
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text('Digite o nome do Proprietário')
                return false
            }
            // alert(NameProp.val())
            if(DocProp.val()==''){
                DocProp.focus()
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text('Digite o documento do Proprietário')
                return false
            }
        }
        return false
    })


    $('form[name="FormVeiculo"]').submit(function(){
        var selectProp=$('#PropVeiculo')
        if(NameProp.val()=='' && selectProp.val()==''){
            NameProp.focus()
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Digite o nome do Proprietário')
            return false
        }
        // alert(NameProp.val())
        if(DocProp.val()=='' && selectProp.val()==''){
            DocProp.focus()
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Digite o documento do Proprietário')
            return false
        }
        // console.log($(this).serialize())

        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            },
            success:function(response){
                // alert(response)
                // console.log(response)
                if(response.status==0){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if(response.status==200){
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)

                }
            },
            error:function(response){
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    });


    $('.a_colaborador_veiculo').click(function(){
        // alert($(this).attr('id'))
        $('form[name="ColaboradorVeiculo"]').show()
        $('form[name="ColaboradorVeiculo"] span').text('Veiculo '+$(this).attr('placa'))
        $('form[name="ColaboradorVeiculo"]').attr('action',$(this).attr('href'))
        // $('input[name="Veiculo"]').val($(this).attr('veiculo'))
        // console.log($('form[name="ColaboradorVeiculo"]').attr('action'))
        return false;
    });
    // $('form[name="ColaboradorVeiculo"]').focusout(function(){
    //     $(this).hide()
    // })
    $('form[name="ColaboradorVeiculo"]').submit(function(){
        // alert($(this).serialize())
        // return false
        $.ajax({
            type:'post',
            url: $(this).attr('action'),
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            },
            success:function(response){
                // alert(response)
                // console.log(response)
                if(response.status==0){
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if(response.status==200){
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg.success)
                    // console.log(response.msg)
                    // console.log('#Veiculo_'+response.msg.veiculo)
                    // console.log(response.msg.veiculoLimpo)
                    $('#Veiculo_'+response.msg.veiculo).text(response.msg.colaborador)
                    if(typeof response.msg.veiculoLimpo.msg === 'undefined'){
                        $('#Veiculo_'+response.msg.veiculoLimpo).text('add colaborador')
                    }else{
                        // $('#Veiculo_'+response.msg.veiculo).text(response.msg.veiculoLimpo.msg)
                        // console.log('tste: '+'#Veiculo_'+response.msg.veiculo)
                        $('.response-message-ajax').text(response.msg.veiculoLimpo.msg)
                    }
                    $('select[name="colaborador"]').val('')
                    $('form[name="ColaboradorVeiculo"]').hide()
                }
            },
            error:function(response){
                $('.response-message-ajax').show().fadeOut(5000)
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    });
});
