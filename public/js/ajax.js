$(function () {

    var base = 'http://localhost:8000/';

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

        // var confirma = confirm('Deseja Cadastrar Carga?');
        var confirma = true;
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
                    $("body").css("overflow", "hidden");
                },
                success: function (response) {
                    // alert('success')


                    // console.log(response)
                    loading.addClass('d-none');
                    $("body").css("overflow", "auto");
                    if (response.status === 'success') {
                        // alert(response.msg)
                        // console.log(response)
                        // $('.response-message-ajax').removeClass('alert-primary')
                        $('.response-message-ajax').addClass('alert-success')
                        $('.response-message-ajax').text(response.msg)
                        window.location.href=''
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

});
