$(function () {



    var base = 'http://localhost:8000/';

    //====================================
    //      PERMISSIONS
    //====================================
    var routeStorePermission = base + 'permissions';

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

});
