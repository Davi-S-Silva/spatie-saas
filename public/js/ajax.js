// const { data } = require("autoprefixer");
$(function () {

    var base = 'http://localhost:8080/';
    // var base = 'http://3.145.53.239/';
    // var base = 'http://saasportal.com.br/';
    // var base = 'http://8ebd-177-206-177-236.ngrok-free.app/';

    //====================================
    //      PERMISSIONS
    //====================================
    var routeStorePermission = base + 'permissions';
    var routeCarga = base + 'carga';
    var loading = $('.loading');

    // loading.hide();

    // alert(routeStorePermission)
    $('.click_botao_direito').on('contextmenu', function(){
        navigator.clipboard.writeText($(this).attr('copy'))
        // alert(textCopy)
        var textoCampo =  $(this).text();
        $(this).append('<span class="span_copy position-absolute left-0"><br />Copiado</span>');
        $('.span_copy').fadeOut(2000);
        return false
    })
    // $(document).on()
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
                    // $('.response-message').html(response.msg)
                    window.location.href = routeStorePermission
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
                    window.location.href = routeStorePermission
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
                        // $('.response-message').removeClass('alert-primary')
                        // $('.response-message').addClass('alert-success')
                        window.location.href = routeStorePermission
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
                    $('.response-message-ajax').addClass('alert-danger').text('erro: ' + response.responseJSON.message)
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
                    // $('.response-message').html(response.msg)
                    window.location.href = routeStoreRole
                }
                if (response.status === 'danger') {
                    // alert(response.msg);
                    $('.response-message').addClass(['alert-danger', 'd-flex'])
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
                    window.location.href = routeStoreRole
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
                        // $('.response-message').removeClass('alert-primary')
                        // $('.response-message').addClass('alert-success')
                        window.location.href = routeStoreRole
                    }
                    if (response.status === 'danger') {
                        // alert(response.msg)
                        // console.log(response)
                        $('.response-message').html(response.msg)
                    }
                },
                error: function (response) {
                    // alert('error')
                    $('.response-message-ajax').addClass('alert-danger').text('erro: ' + response.responseJSON.message)
                    // console.log(response.responseJSON.message)
                }
            });
        }
        return false
    });


    $('form[name="FormCarregaNotas"]').submit(function () {

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
                    loading.css('display', 'flex')
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
                        window.location.href = ''
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
                    // $('.response-message-ajax').addClass('alert-danger').text('erro: '+response)
                    console.log(response)
                }
            });
        }
        return false;
    });

    // FormNovaCarga

    var LocalResponseAjaxCarga = $('.local_include_ajax_response_carga');

    $(document).on('click', '.add-notas-carga', function () {
        $('.form_add_notas').show();
        $('.form_add_notas').attr('action', $(this).attr('href'))
        $('.form_add_notas legend').text($(this).attr('id'))
        return false;
    })
    $('form[name="FormNovaCarga"]').submit(function () {

         var confirma = confirm('Deseja Cadastrar Carga?');
        // var confirma = true;

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


                    // console.log(response)

                    if (response.status === 'success') {
                        // alert(response.msg)
                        // console.log(response)
                        $('.response-message-ajax').removeClass('alert-danger')
                        $('.response-message-ajax').addClass('alert-success')
                        $('.response-message-ajax').show();
                        // window.location.href=routeStoreRole
                        // console.log(response.carga.id)
                        $('.response-message-ajax').text(response.msg)
                        LocalResponseAjaxCarga.append('<a class="btn btn-primary add-notas-carga"  href="/carga/'+response.carga.id+'/setnotas" id="Carga '+response.carga.id+'">Add Notas</a>');

                    }
                    if (response.status === 'danger') {
                        // alert(response.msg)
                        // console.log(response)
                        $('.response-message-ajax').removeClass('alert-success')
                        $('.response-message-ajax').addClass('alert-danger')
                        $('.response-message-ajax').show();
                        $('.response-message-ajax').html(response.msg)
                    }
                },
                error: function (response) {
                    // alert('error')
                    // $('.response-message-ajax').addClass('alert-danger').text('erro: ' + response.responseJSON.message)
                    console.log(response)
                }
            });
        }
        return false;
    });

    $('form[name="EditCarga"]').submit(function () {

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
                    // $('.response-message').removeClass('alert-primary')
                    // $('.response-message').addClass('alert-success')
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
                $('.response-message-ajax').addClass('alert-danger').text('erro: ' + response.responseJSON.message)
                // console.log(response.responseJSON.message)
            }
        });

        return false;
    });

    $('.exclui_nota').click(function () {
        $.ajax({
            type: 'get',
            url: 'deleta-nota-carregada/' + $(this).attr('href'),
            success: function (response) {
                // console.log(response)
                $('.response-message-ajax').addClass('alert-success')
                $('.response-message-ajax').text(response.msg)
                var nota = response.nota;

                console.log(nota)
                $("#nota" + nota).removeClass('d-flex')
                $("#nota" + nota).css('display', 'none')
                // window.location.href=''
            },
            error: function (response) {
                console.log(response)
            }
        })
        return false;
    });

    $('input[name="SelectAll"]').click(function () {

        if ($(this).prop("checked")) {
            $('input[name="Notas[]"]').prop(
                "checked", true
            )
        } else {
            $('input[name="Notas[]"]').prop(
                "checked", false
            )
        }
        // alert('ola')
    });


    $('form[name="FormExcluirNotas"]').submit(function () {
        // console.log($(this).serialize())


        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (response) {
                console.log(response)
                $('.response-message-ajax').addClass('alert-success')
                $('.response-message-ajax').text(response.msg)
                var nota = response.nota;
                $("#nota" + nota).removeClass('d-flex')
                $("#nota" + nota).css('display', 'none')
                window.location.href = ''
            },
            error: function (response) {
                console.log(response)
            }
        });
        return false;
    });

    if ($('.form_add_notas').attr('action') == "") {
        $('.form_add_notas').hide();
    }

    $('.response-message-ajax').click(function () {
        $(this).hide()
    })
    $('.add-notas-carga').click(function () {
        // console.log($(this).attr('href'));
        $('.form_add_notas').show();
        $('.form_add_notas').attr('action', $(this).attr('href'))
        $('.form_add_notas legend').text($(this).attr('id'))
        return false;
    });

    $('.form_add_notas').submit(function () {

        // console.log($('.form_add_notas').attr('action'))
        var txt = '';
        var notas = []
        $.ajax({
            type: 'post',
            url: $('.form_add_notas').attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                // console.log($('.form_add_notas').attr('action'))
                // loading.show()
                loading.css('display', 'flex')
                loading.removeClass('d-none');
            },
            success: function (response) {
                // console.log(response)
                loading.hide()
                if (response.status == 0) {
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').show()
                    if (response.notas != undefined) {
                        console.log(response.notas)
                        // response.notas.each(function(index){
                        // })
                        // i = 0
                        $.each(response.notas, function (i, val) {
                            notas.push(val);
                        })
                        $.each(notas, function (i, val) {
                            txt += val
                            if (i < (notas.length - 1)) {
                                txt += '-'
                            }
                        })
                        // console.log(notas.length)
                        $('.response-message-ajax').text('Notas ' + txt + ' não encontradas')
                        return
                    }
                    $('.response-message-ajax').text('erro: ' + response.msg)
                    // $('.response-message-ajax').fadeOut(10000)

                }
                if (response.status == 200) {
                    console.log(response.msg);
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').text(response.msg)
                }
            },
            error: function (response) {
                console.log('erro: ' + response)
            }
        });

        return false;
    });
    $('.form_add_notas a').click(function () {
        $('.textarea_notas').val('')
        $('.form_add_notas').hide();
        return false;
    });




    $('.link_carga_entrega').click(function () {
        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            // data:
            dataType: 'json',
            success(response) {
                // console.log(response)
                if (response.status == 200) {
                    $('.local_cargas_entrega').html('');
                    if ($(response.cargas).length != 0) {
                        $('.response-message-ajax').show()
                        $('.response-message-ajax').removeClass('alert-danger')
                        $('.response-message-ajax').addClass('alert-success')
                        $('.response-message-ajax').text('Cargas encontradas para o cliente ' + response.cliente)
                    } else {
                        $('.response-message-ajax').show()
                        $('.response-message-ajax').addClass('alert-danger')
                        $('.response-message-ajax').removeClass('alert-success')
                        $('.response-message-ajax').text('Cargas não encontradas para o cliente ' + response.cliente)
                    }
                    $(response.cargas).each(function (i, e) {
                        $('.local_cargas_entrega').append('<div class="d-flex flex-column"><input type="checkbox" id="Carga_' + e.id + '" name="Cargas[]" title="' + e.os + ' - ' + e.area + ' - ' + e.motorista + '" value="' + e.id + '"/><label for="Carga_' + e.id + '" class=""><div><b>Motorista: </b> ' +
                            e.motorista + '</div><div><b>OS: </b> ' + e.os + '</div><div><b>Remessa: </b> ' + e.remessa + '</div><div><b>Área: </b>' + e.area + '</div></label></div>');
                    });
                }
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    return false
                }
            },
            error(response) {

            }
        });
        return false;
    });

    // $('form[name="FormEntrega"]').submit(function(){
    //     console.log($(this).serialize())
    //     return false;
    // });
    // $('input[name="SemAjudante"]').hide()
    $('form[name="FormEntrega"]').submit(function () {
        // console.log($(this).serialize())
        var Carga = $('input[name="Cargas[]"]')

        if (Carga.length == 0) {
            // console.log('selecione o cliente')
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('selecione o cliente')
            return false
        }
        var countChecked = 0;
        var textCargas = 'Cargas: '
        $(Carga).each(function (i, e) {
            //    console.log(e)
            if (e.checked == true) {
                countChecked++
                textCargas += `${e.title} `
            }
            //    console.log('valor: '+ e.value)
        })

        if (Carga.length != 0 && countChecked < 1) {
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

        var confirma = confirm('Deseja Cadastrar Entrega? ' + textCargas + '\n');

        if (confirma) {
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {

                },
                success: function (response) {
                    // console.log(response)
                    if (response.status == 200) {
                        $('.response-message-ajax').removeClass('alert-danger')
                        $('.response-message-ajax').addClass('alert-success')
                        $('.response-message-ajax').text(response.msg)
                        $('.response-message-ajax').show()
                    }
                    if (response.status == 0) {
                        $('.response-message-ajax').removeClass('alert-success')
                        $('.response-message-ajax').addClass('alert-danger')
                        $('.response-message-ajax').text(response.msg)
                        $('.response-message-ajax').show()
                        return false
                    }
                },
                error: function (response) {
                    console.log(response)
                }
            });
        }
        return false;
    })

    $('form[name="FormMovimentacao"]').submit(function () {
        var partida = $('#LocalPartida')
        var destino = $('select[name="LocalDestino"]')
        // alert(partida.value)
        // console.log(partida.val())
        if (partida.val() == '') {
            partida.focus()
            $('.response-message-ajax').show().fadeOut(5000)
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Selecione o local de partida')
            return false
        } else {
            // alert('teste')
            $('.response-message-ajax').hide()
        }
        if (destino.val() == '') {
            destino.focus()
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Selecione o local de destino')
            return false
        } else {
            // alert('teste')
            $('.response-message-ajax').hide()
        }

        if (destino.val() == partida.val()) {
            destino.focus()
            $('.response-message-ajax').show().fadeOut(5000)
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('O local de destino nao pode ser igual ao local de partida')
            return false;
        }

        var textDesc = $('textarea[name="DescricaoMov"]')
        if (textDesc.val() == '') {
            textDesc.focus()
            $('.response-message-ajax').show().fadeOut(5000)
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Digite uma descricao ou motivo da movimentacao')
            return false
        }

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                if (response.status == 200) {
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    return false
                } else {
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response)
                    return false;
                }
            },
            error: function (response) {
                $('.response-message-ajax').show().fadeOut(5000)
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response)
                return false;
            }
        })
        return false;
    });


    // $('.stop_mov_ajax').hide()

    $('.start_mov').click(function () {
        // alert($(this).attr('href'))
        $('form[name="StartMov"]').show()
        $('form[name="StartMov"]').attr('action', $(this).attr('href'))
        $('form[name="StartMov"] span').text($(this).attr('mov'))
        $('select[name="colaborador"]').val($(this).attr('mot'))
        $('input[name="Mov"]').val($(this).attr('mov'))
        $('form[name="StopMov"]').hide()
        return false
    })

    $('form[name="StartMov"]').submit(function () {
        // alert(
        //     $(this).attr('action')
        // )
        // return false
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response)
                }
                if (response.status == 200) {
                    console.log(response)
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)

                    $('#Start_Mov_' + response.mov.id).hide()
                    $('form[name="StartMov"]').hide()

                    // console.log()
                    $('#Stop_Mov_' + response.mov.id).removeClass('d-none')
                    $('input[name="KmInicial"]').val('')
                }
            },
            error: function (response) {
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    })

    $('.stop_mov').click(function () {
        $('form[name="StopMov"]').show()
        $('form[name="StopMov"]').attr('action', $(this).attr('href'))
        $('form[name="StopMov"] span').text($(this).attr('mov'))
        $('input[name="Mov"]').val($(this).attr('mov'))
        // alert($('input[name="Mov"]').val())
        $('form[name="StartMov"]').hide()
        return false
    })


    $('form[name="StopMov"]').submit(function () {
        // alert($('input[name="Mov"]').val())
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                }
                if (response.status == 200) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    $('#Stop_Mov_' + response.mov.id).hide()
                    $('form[name="StopMov"]').hide()
                    $('input[name="KmFinal"]').val('')
                }
            },
            error: function (response) {
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                console.log(response.msg)
                return false;
            }
        })
        return false
    })

    $('.conteudo_sistema').click(function () {
        var IncludeResponseAjax = $('#IncludeResponseAjax')
        IncludeResponseAjax.hide()
        // $('form[name="StartEntrega"]').hide()
        // $('form[name="StopEntrega"]').hide()
    })
    $('.exibe_entrega').click(function () {
        // var IncludeResponseAjax = $('#IncludeResponseAjax')
        // IncludeResponseAjax.hide()
        $('form[name="StartEntrega"]').hide()
        $('form[name="StopEntrega"]').hide()
    })

    $('.start_entrega').click(function () {
        $('form[name="StartEntrega"]').show()
        $('form[name="StopEntrega"]').hide()
        $('form[name="StartEntrega"]').attr('action', $(this).attr('href'))
        $('form[name="StartEntrega"] span').text($(this).attr('entrega'))
        $('input[name="Entrega"]').val($(this).attr('Entrega'))
        // // alert($('input[name="Mov"]').val())
        // $('form[name="StartMov"]').hide()
        return false
    })
    $('.stop_entrega').click(function () {
        // console.log()
        // return false
        $('form[name="StartEntrega"]').hide()
        $('form[name="StopEntrega"]').show()
        $('form[name="StopEntrega"]').attr('action', $(this).attr('href'))
        $('form[name="StopEntrega"] span').text($(this).attr('entrega'))
        $('input[name="Entrega"]').val($(this).attr('Entrega'))
        // // alert($('input[name="Mov"]').val())
        // $('form[name="StartMov"]').hide()
        return false
    })
    $('form[name="StartEntrega"]').submit(function () {
        // alert($(this).attr('action'))
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    $('form[name="StopEntrega"]').hide()
                    $('form[name="StartEntrega"]').hide()
                }
                if (response.status == 200) {
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
            error: function (response) {
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    })
    $('form[name="StopEntrega"]').submit(function () {
        // alert($(this).attr('action'))
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    $('form[name="StopEntrega"]').hide()
                    $('form[name="StartEntrega"]').hide()
                }
                if (response.status == 200) {
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
            error: function (response) {
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
    NameProp.attr('disabled', 'disabled')
    DocProp.attr('disabled', 'disabled')
    $("#LinkNovoProp").click(function () {
        $('#NovoProp').toggle()
        var selectProp = $('#PropVeiculo')


        if (selectProp.attr('disabled')) {
            selectProp.removeClass('d-none')
            selectProp.removeAttr('disabled')
            NameProp.attr('disabled', 'disabled')
            DocProp.attr('disabled', 'disabled')
        } else {
            selectProp.attr('disabled', 'disabled')
            selectProp.addClass('d-none')
            DocProp.removeAttr('disabled')
            NameProp.removeAttr('disabled')
            NameProp.toggle()
            DocProp.toggle()

            selectProp.val('')

            // alert(NameProp.val())
            if (NameProp.val() == '') {
                NameProp.focus()
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text('Digite o nome do Proprietário')
                return false
            }
            // alert(NameProp.val())
            if (DocProp.val() == '') {
                DocProp.focus()
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text('Digite o documento do Proprietário')
                return false
            }
        }
        return false
    })


    $('form[name="FormVeiculo"]').submit(function () {
        var selectProp = $('#PropVeiculo')
        if (NameProp.val() == '' && selectProp.val() == '') {
            NameProp.focus()
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Digite o nome do Proprietário')
            return false
        }
        // alert(NameProp.val())
        if (DocProp.val() == '' && selectProp.val() == '') {
            DocProp.focus()
            $('.response-message-ajax').show()
            $('.response-message-ajax').addClass('alert-danger')
            $('.response-message-ajax').text('Digite o documento do Proprietário')
            return false
        }
        // console.log($(this).serialize())

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if (response.status == 200) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    //Esconde o formulario de cadastro do primeiro veiculo
                    //dos cadastros inciais do sistema
                    $("#PrimeiroVeiculo").hide()
                }
            },
            error: function (response) {
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    });

    $('form[name="FormColaborador"]').submit(function () {

        console.log($(this).serialize())

        // return false

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if (response.status == 200) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    //Esconde o formulario de cadastro do primeiro colaborador
                    //dos cadastros inciais do sistema
                    $("#PrimeiroColaborador").hide()
                }
            },
            error: function (response) {
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    });
    $('form[name="FormCliente"]').submit(function () {

        console.log($(this).serialize())

        // return false

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if (response.status == 200) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    console.log(response.msg)
                    //Esconde o formulario de cadastro do primeiro colaborador
                    //dos cadastros inciais do sistema
                    $("#PrimeiroCliente").hide()
                }
            },
            error: function (response) {
                $('.response-message-ajax').show()
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    });


    $('.a_colaborador_veiculo').click(function () {
        // alert($(this).attr('id'))
        $('form[name="ColaboradorVeiculo"]').show()
        $('form[name="ColaboradorVeiculo"] span').text('Veiculo ' + $(this).attr('placa'))
        $('form[name="ColaboradorVeiculo"]').attr('action', $(this).attr('href'))
        // $('input[name="Veiculo"]').val($(this).attr('veiculo'))
        // console.log($('form[name="ColaboradorVeiculo"]').attr('action'))
        return false;
    });
    // $('form[name="ColaboradorVeiculo"]').focusout(function(){
    //     $(this).hide()
    // })
    $('form[name="ColaboradorVeiculo"]').submit(function () {
        // alert($(this).serialize())
        // return false
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                if (response.status == 0) {
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }
                if (response.status == 200) {
                    $('.response-message-ajax').show().fadeOut(5000)
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg.success)
                    // console.log(response.msg)
                    // console.log('#Veiculo_'+response.msg.veiculo)
                    // console.log(response.msg.veiculoLimpo)
                    $('#Veiculo_' + response.msg.veiculo).text(response.msg.colaborador)
                    if (typeof response.msg.veiculoLimpo.msg === 'undefined') {
                        $('#Veiculo_' + response.msg.veiculoLimpo).text('add colaborador')
                    } else {
                        // $('#Veiculo_'+response.msg.veiculo).text(response.msg.veiculoLimpo.msg)
                        // console.log('tste: '+'#Veiculo_'+response.msg.veiculo)
                        $('.response-message-ajax').text(response.msg.veiculoLimpo.msg)
                    }
                    $('select[name="colaborador"]').val('')
                    $('form[name="ColaboradorVeiculo"]').hide()
                }
            },
            error: function (response) {
                $('.response-message-ajax').show().fadeOut(5000)
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response.msg)
                return false;
            }
        })
        return false
    });

    $('.area-show-detalhe').hide()
    $('.show-detalhe-items').click(function () {
        // $('.area-show-detalhe').hide()
        // console.log($(this).text())
        // $('.area-show-detalhe').toggle()
        $('#Item_' + $(this).attr('Item')).toggle()
        // $('.show-detalhe-cargas').text('+')
        if ($(this).html() == '<i class="fa-regular fa-square-minus"></i>') {
            // console.log('negativo')
            $(this).html('<i class="fa-regular fa-square-plus"></i>')
        } else {
            // console.log('positivo')
            $(this).html('<i class="fa-regular fa-square-minus"></i>')
        }
        // $(this).text('-')

        return false;
    })


    // atualiza-nota-component
    $('.atualiza_nota_component').click(function () {
        var IncludeResponseAjax = $('#IncludeResponseAjax')
        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            beforeSend: function () {
                // alert(routeStorePermission)
                // loading.css('display', 'flex')
                // loading.removeClass('d-none');
                // $("body").css("overflow", "hidden");
            },
            success: function (response) {
                // alert(response)
                // console.log(response)

                IncludeResponseAjax.html('')
                IncludeResponseAjax.show()
                if (response.status == 0) {
                    IncludeResponseAjax.html(response.msg)
                    return false;
                }
                IncludeResponseAjax.html(response)
                return false;
            },
            error: function (response) {
                console.log(response)
                return false;
            }
        })
        return false
    })
    //Atualizar nota
    $(document).on('submit', 'form[name="UpdateStatusNota"]', function () {
        var IncludeResponseAjax = $('#IncludeResponseAjax')
        var Comprovantes = $('input[name="Comprovantes[]"]')
        var StatusNota = $('select[name="StatusNota"]')
        // console.log(StatusNota.val())
        // var StatusNota = $('select[name="StatusNota"]')
        //
        if (StatusNota.val() == 27 && Comprovantes.val() == '' && !$('#PagoDiretoEmpresa').is(':checked')) {
            Comprovantes.attr('required', 'required')
            console.log('27 status ' + StatusNota.val())
            Comprovantes.focus()
            return false;
        }
        if (StatusNota.val() == 31) {
            console.log('status ' + StatusNota.val())
            Comprovantes.removeAttr('required')
        }


        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            // dataType: 'json',
            // data:$(this).serialize(),
            // dataType: 'json',
            // cache: false,
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                // alert(routeStorePermission)
                // loading.css('display', 'flex')
                // loading.removeClass('d-none');
                // $("body").css("overflow", "hidden");
            },
            success: function (response) {
                // alert(response)
                if (response.status == 200) {
                    var status = (response.msg.status)
                    var nota = $('#Div_Nota_' + response.msg.nota)
                    var obsNota = $('#Obs_Nota_' + response.msg.nota)
                    var UserNota = $('#User_Conclusao_Nota_' + response.msg.nota)
                    var DataNota = $('#Data_Conclusao_Nota_' + response.msg.nota)
                    console.log('id nota: ' + response.msg.nota)
                    if (status == 27) {
                        nota.removeClass('bg-notas-danger')
                        nota.addClass('bg-notas-success')
                    }

                    UserNota.text(response.msg.user_conclusao)
                    DataNota.text(response.msg.data_conclusao)
                    obsNota.text(response.msg.obs)
                    if (status == 31) {
                        nota.removeClass('bg-notas-success')
                        nota.addClass('bg-notas-danger')
                        // obsNota.text(response.msg.obs)
                    }
                }

                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    // IncludeResponseAjax.hide()
                    return false;
                }
                // console.log(response)
                IncludeResponseAjax.hide()
                return false;
            },
            error: function (response) {
                console.log(response)
                return false;
            }
        })
        return false
    })

    $(document).on('click', '#PagoDiretoEmpresa', function () {
        // console.log('alert...')
        var Comprovantes = $('input[name="Comprovantes[]"]')
        // console.log($('#PagoDiretoEmpresa').attr('checked'))
        var StatusNota = $('select[name="StatusNota"]')
        if ($('#PagoDiretoEmpresa').is(':checked')) {
            // console.log('not required')
            Comprovantes.removeAttr('required')
        } else {
            // console.log('required')
            Comprovantes.attr('required', 'required')
        }

        if (StatusNota.val() == 31) {
            Comprovantes.removeAttr('required')
        }
    })
    $(document).on('click', '#ClonaInputComprovante', function () {
        console.log('clonando comprovante')
        $('#Comprovantenota').clone(true).appendTo('#CloneComprovante').val('').removeAttr('id');
        return false
    })
    $(document).on('click', '#RemoveComprovante', function () {
        var Comprovantes = $('input[name="Comprovantes[]"]')
        // console.log('removendo comprovante '+ Comprovantes.length)
        // Comprovantes.each(function(i,e){

        // })
        var ultimoItem = Comprovantes[Comprovantes.length - 1]
        if (Comprovantes.length > 1) {
            ultimoItem.remove();
            console.log('removendo comprovante')
        }
        // $('#Comprovantenota').clone(true).appendTo('#CloneComprovante').val('').removeAttr('id');
        return false
    })




    $('.submit_entrega').click(function () {
        // console.log($(this).attr('name'))
        notas = $('input[name="Notas[]"]:checked')
        // notas.each(function(valor, index){
        // console.log()
        if (notas.length == 0) {
            alert('Ação Cancelada: Nenhuma nota Selecionada');
            return false;
        }
        // })
        // return false;
        if ($(this).attr('name') == 'Devolver') {
            motivo = prompt("Qual o motivo?");
            // console.log(motivo);
            if (motivo == null || motivo == '') {
                alert('Ação Cancelada');
                return false;
            }
            $('form[name="FormEncerraEntrega"] input[name="Receber"]').remove();
            $('form[name="FormEncerraEntrega"] input[name="Calcular"]').remove();
            if (motivo) {
                $('form[name="FormEncerraEntrega"]').append('<input type="hidden" name="Motivo" value="' + motivo + '"/>')
                $('form[name="FormEncerraEntrega"]').append('<input type="hidden" name="Devolver" value="Devolver"/>')

            }
            // $('form[name="FormEncerraEntrega"]').submit();
            // return false;
        }
        if ($(this).attr('name') == 'Calcular') {
            $('form[name="FormEncerraEntrega"] input[name="Motivo"]').remove();
            $('form[name="FormEncerraEntrega"] input[name="Receber"]').remove();
            $('form[name="FormEncerraEntrega"] input[name="Devolver"]').remove();
            $('form[name="FormEncerraEntrega"]').append('<input type="hidden" name="Calcular" value="Calcular"/>')
            // $('form[name="FormEncerraEntrega"]').submit();
            // return false;
        }
        if ($(this).attr('name') == 'Receber') {
            $('form[name="FormEncerraEntrega"] input[name="Motivo"]').remove();
            $('form[name="FormEncerraEntrega"] input[name="Devolver"]').remove();
            $('form[name="FormEncerraEntrega"] input[name="Calcular"]').remove();
            $('form[name="FormEncerraEntrega"]').append('<input type="hidden" name="Receber" value="Receber"/>')
            // $('form[name="FormEncerraEntrega"]').submit();

            // var notas = $('input[name="Notas[]"]')
            // console.log($(notas).length)
            // var arrayNotas = [];
            // $(notas).each(function(i, e){
            //     if($(e).is(':checked')){
            //         arrayNotas.push(e)
            //     }
            // });
            // console.log(arrayNotas)
            // return false;

        }
        $('form[name="FormEncerraEntrega"]').submit();
        // $('form[name="FormEncerraEntrega"]').append('<input type="hidden" name="'+$(this).attr('name')+'" value="'+$(this).attr('name')+'"/>')


    })

    $(document).on('submit', 'form[name="UpdateStatusNotas"]', function () {
        var IncludeResponseAjax = $('#IncludeResponseAjax')
        // console.log($(this).attr('action'));
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            // dataType: 'json',
            // data: $(this).serialize(),
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {

            },
            success: function (response) {

                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    // console.log('teste '+response.msg)
                    // IncludeResponseAjax.hide();
                    return false;
                }

                console.log(response)
                if (response.status == 200) {

                    // var status = (response.msg.status)

                    $(response.msg.notas).each(function (i, e) {
                        // console.log('#Checkbox_Nota_'+e)
                        var nota = $('#Div_Nota_' + e)
                        var obsNota = $('#Obs_Nota_' + e)
                        var UserNota = $('#User_Conclusao_Nota_' + e)
                        var DataNota = $('#Data_Conclusao_Nota_' + e)
                        console.log('id nota: ' + e)
                        nota.removeClass('bg-notas-danger')
                        nota.addClass('bg-notas-success')
                        UserNota.text(response.msg.user_conclusao)
                        DataNota.text(response.msg.data_conclusao)
                        obsNota.text(response.msg.obs)
                        $('#Checkbox_Nota_' + e).attr('checked', false)
                        $('.nota-select').css({ 'background': 'none' })
                    })
                    IncludeResponseAjax.hide();

                    return false;
                }

            },
            error: function (response) {

                return false;
            }
        })
        return false
    })

    $('form[name="FormEncerraEntrega"]').submit(function () {
        // console.log($(this).serialize())
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            // dataType: 'json',
            // data: $(this).serialize(),
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {

            },
            success: function (response) {
                // alert(response)
                // console.log(response)
                var IncludeResponseAjax = $('#IncludeResponseAjax')
                if (response.acao == undefined) {
                    IncludeResponseAjax.html(response)
                    IncludeResponseAjax.show()
                    // console.log(response)
                    return false;
                }
                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    // console.log('teste '+response.msg)
                    return false;
                }

                if (response.status == 200) {

                    // if(response.acao == 'Receber'){
                    //     var IncludeResponseAjax = $('#IncludeResponseAjax')
                    //     IncludeResponseAjax.html(response.form)
                    //     IncludeResponseAjax.show()
                    //     console.log(response)
                    //     return false;
                    // }

                    if (response.acao == 'Calcular') {
                        $('.pesoLiquido').html('');
                        $('.pesoLiquido').append('<b>pesoLiquido: </b>' + response.info.pesoLiquido + 'Kg');
                        $('.pesoBruto').html('');
                        $('.pesoBruto').append('<b>pesoBruto: </b>' + response.info.pesoBruto + 'Kg');
                        $('.valor').html('');
                        $('.valor').append('<b>Valor: </b>R$ ' + response.info.valor);
                        $('.volume').html('');
                        $('.volume').append('<b>Volume: </b>' + response.info.volume);
                        $('.qtdnotas').html('');
                        $('.qtdnotas').append('<b>Quantidade Notas: </b>' + response.info.qtdNotas);
                        // <li><b>Valor: </b>R$ '
                        //     +response.info.valor+'</li><li><b>Volume: </b>'+response.info.volume+'</li></ul> < class=" d-flex flex-wrap">'+

                        $('.lista-resposta-calculo').html('')
                        i = 0;
                        $.each(response.info.notas, function (i, val) {
                            $('.lista-resposta-calculo').append((i < response.info.notas.length - 1) ? val + ', ' : val)
                            i++
                        });
                        $('#AreaResultados').show()
                        $('body').css('overflow', 'hidden')
                    }

                    if (response.acao == 'Devolver') {

                        // console.log(response)
                        // console.log(response.msg.Motivo)

                        $.each(response.notas, function (i, e) {
                            var nota = $('#Div_Nota_' + e)
                            var obsNota = $('#Obs_Nota_' + e)
                            var UserNota = $('#User_Conclusao_Nota_' + e)
                            var DataNota = $('#Data_Conclusao_Nota_' + e)
                            var status = (response.msg.status)
                            // if(status==27){
                            //     nota.removeClass('bg-notas-danger')
                            //     nota.addClass('bg-notas-success')
                            // }

                            UserNota.text(response.user_conclusao)
                            DataNota.text(response.data_conclusao)
                            if (status == 31) {
                                nota.removeClass('bg-notas-success')
                                nota.addClass('bg-notas-danger')
                                obsNota.text(response.msg.Motivo)
                            }
                            // IncludeResponseAjax.html(response)
                            // IncludeResponseAjax.show()
                        })
                    }
                }
            },
            error: function (response) {

                return false;
            }
        })
        return false
    })
    $('.close_modal').click(function () {
        $('#AreaResultados').hide()
        $('body').css('overflow', 'auto')
    });
    $('.cidade_frete').click(function () {
        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            beforeSend: function () {
                // alert(routeStorePermission)
                loading.css('display', 'flex')
                loading.removeClass('d-none');
                // $("body").css("overflow", "hidden");
            },
            success: function (response) {
                // console.log(response)
                if (response.status == 200) {

                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text("Cidade: " + response.msg.cidade + " Frete: " + "R$ " + response.msg.frete)
                    // var nota = response.nota;

                    // console.log(response.msg)
                    $("#CidadeFrete").text(response.msg.cidade)
                    $("#ValorFrete").text("R$ " + response.msg.frete)
                    $("#FreteCity").show()
                    $("#FreteCity").addClass('d-flex ')
                    $("#FreteCity").css({
                        // "background-color":"green",
                        "height": "fit-content",
                        "padding": "10px"
                    })

                }

                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                }

                loading.addClass('d-none');
            },
            error: function (response) {
                console.log(response)
            }
        })
        return false;
    });

    $('form[name="FormAbastecimento"]').submit(function () {
        $('input[name="ajax"]').remove()
        $(this).append('<input type="hidden" name="ajax" value="ajax"/>')
        console.log($(this).attr('action'))
        console.log(new FormData(this))
        // return false;
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            // data: $(this).serialize(),
            data: new FormData(this),
            // dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // alert(routeStorePermission)
                // loading.css('display', 'flex')
                // loading.removeClass('d-none');
                // $("body").css("overflow", "hidden");
            },
            success: function (response) {
                console.log(response)
                //  return false;
                if (response.status == 200) {

                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-danger')
                    $('.response-message-ajax').addClass('alert-success')
                    $('.response-message-ajax').text(response.msg)
                    // var nota = response.nota;

                    // console.log(response.msg)
                    location.href = base + "abastecimento";

                }

                if (response.status == 0) {
                    $('.response-message-ajax').show()
                    $('.response-message-ajax').removeClass('alert-success')
                    $('.response-message-ajax').addClass('alert-danger')
                    $('.response-message-ajax').text(response.msg)
                    // console.log(response.msg)
                }
                loading.addClass('d-none');
            },
            error: function (response) {
                // console.log(response)
                $('.response-message-ajax').show()
                $('.response-message-ajax').removeClass('alert-success')
                $('.response-message-ajax').addClass('alert-danger')
                $('.response-message-ajax').text(response)
                loading.addClass('d-none');
            }
        })
        return false;
    });

    //get semi reboques
    $('.get_semireboques').click(function () {
        // console.log($(this).attr('veiculo'))
        var veiculo = $(this).attr('veiculo')
        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            success: function (response) {
                // console.log(response)
                // $('.response-message-ajax').addClass('alert-success')
                // $('.response-message-ajax').text(response.veiculos)
                // var nota = response.nota;

                var ResponseVeiculos = $('#ResponseVeiculos');
                ResponseVeiculos.html('')
                ResponseVeiculos.show()
                // console.log(response.veiculos)
                ResponseVeiculos.append('<div id="LocalVeiculos"><label>Selecione o Semireboque</label></div>');
                $(response.veiculos).each(function (i, e) {
                    // console.log(e.placa)
                    $('#LocalVeiculos').append('<a href="veiculo/' + veiculo + '/atrelarsemireboque/' + e.id + '" class="atrelar_semireboque" id="SemiReboque_' + e.id + '">' + e.placa + '</a>')
                })
                // $("#nota"+nota).removeClass('d-flex')
                // $("#nota"+nota).css('display','none')
                // window.location.href=''
            },
            error: function (response) {
                console.log(response)
            }
        })
        return false;
    });

    $(document).on("click", ".atrelar_semireboque", function () {
        var confirma = confirm('Deseja atrelar esse reboque nesse veiculo?')
        // var confirma = confirm('Deseja deletar esta permissao?');
        var ResponseVeiculos = $('#ResponseVeiculos');
        $('.response-message-ajax').hide()
        if (confirma) {
            $.ajax({
                type: 'get',
                url: $(this).attr('href'),
                success: function (response) {
                    // console.log(response)
                    $('.response-message-ajax').addClass('alert-success')
                    // $('.response-message-ajax').text(response.veiculos)
                    // var nota = response.nota;

                    ResponseVeiculos.html('')
                    ResponseVeiculos.hide()
                    $('.response-message-ajax').show()
                    $('#Semireboque_' + response.msg.veiculo).text(response.msg.semireboque)
                    if (response.msg.veiculoLimpo.status == 0) {
                        $('.response-message-ajax').text(response.msg.veiculoLimpo.msg)
                        return false
                    } else {
                        $('#Semireboque_' + response.msg.veiculoLimpo).text('atrelar reboque')
                    }
                    $('.response-message-ajax').text(response.msg.success)
                },
                error: function (response) {
                    console.log(response)
                }
            })

        } else {
            ResponseVeiculos.html('')
            ResponseVeiculos.hide()
            alert('ação cancelada pelo usuário')
        }

        return false;
    })

    if ($('div').hasClass('monitorar_veiculo')) {
        var LeafIcon = L.Icon.extend({
            options: {
                // shadowUrl: base+'img/OGD9J14.png',
                // shadowUrl: 'C:/xampp_bkp/htdocs/spatie-saas/public/img/OGD9J14.png',
                iconSize: [100, 70],
                shadowSize: [50, 64],
                iconAnchor: [0, 0],
                shadowAnchor: [4, 62],
                popupAnchor: [0, 0]
            }
        });
        // var count = 1;
        var veiculo = $('.monitorar_veiculo').attr('veiculo')
        var Response = $('#AreaDadosAjaxMonitoramento')
        $.ajax({
            type: 'get',
            url: '/localizacao/monitorar/' + veiculo + '/realtime',
            success: function (response) {
                Response.html('')
                Response.html(response)
            },
            error: function (response) {
                console.log(response)
            }
        })
        //fazer outra requisicao para alimentar o mapa

        $.ajax({
            type: 'get',
            url: '/localizacao/monitorar/' + veiculo + '/realtime/maps',
            // url: '/localizacao/monitorar/' + veiculo + '/realtime',
            success: function (response) {
                var map = L.map('map').setView([response.dados.latitude, response.dados.longitude], 17);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    minZoom: 8,
                    maxZoom: 19
                }).addTo(map);
                console.log(response.dados)
                var markerGroup = L.featureGroup([]).addTo(map);
                var latLng = L.latLng([response.dados.latitude, response.dados.longitude]);
                // L.marker(latLng)
                var greenIcon = new LeafIcon({ iconUrl: base + 'img/OGD9J14.png' });
                L.marker(latLng, { icon: greenIcon }).addTo(map).bindPopup('Placa: ' + response.dados.placa + '<br>Endreço: ' + response.dados.endereco + ' <br>Atualização local: ' + response.dados.updateLocal)
                    .addTo(markerGroup)
                    .addTo(map);
            },
            error: function (response) {
                console.log(response)
            }
        })
        // var  map = L.map('map').setView([ -8.122895,-34.918538], 17);
        //         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        //           minZoom: 1,
        //           maxZoom: 19
        //         }).addTo(map);
        setInterval(function () {

            // console.log('teste')
            $.ajax({
                type: 'get',
                url: '/localizacao/monitorar/' + veiculo + '/realtime',
                success: function (response) {
                    Response.html('')
                    Response.html(response)
                },
                error: function (response) {
                    console.log(response)
                }
            })
            $.ajax({
                type: 'get',
                url: '/localizacao/monitorar/' + veiculo + '/realtime/maps',
                // url: '/localizacao/monitorar/' + veiculo + '/realtime',
                success: function (response) {
                    // var  map = L.map('map').setView([response.dados.latitude,response.dados.longitude], 17);
                    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    //   attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    //   minZoom: 1,
                    //   maxZoom: 19
                    // }).addTo(map);
                    var markerGroup = L.featureGroup([]).addTo(map);
                    var latLng = L.latLng([response.dados.latitude, response.dados.longitude]);
                    var greenIcon = new LeafIcon({ iconUrl: base + 'img/OGD9J14.png' });
                    // L.marker(latLng)
                    L.marker(latLng, { icon: greenIcon }).addTo(map).bindPopup('Placa: ' + response.dados.placa + '<br>Endreço: ' + response.dados.endereco + ' <br>Atualização local: ' + response.dados.updateLocal)
                        .addTo(markerGroup)
                        .addTo(map);
                },
                error: function (response) {
                    console.log(response)
                }
            })
            // console.log(count++)
        }, 1000 * 60 * 3);// 3 minutos
        // }, 1000*60*5);// 5 minutos
        // }, 500);//1 segundo
        // }, 1000);//1 segundo
    }

    // MONITORAR TODOS OS VEICULOS

    if ($('div').hasClass('monitorar_todos_veiculo')) {
        var LeafIcon = L.Icon.extend({
            options: {
                // shadowUrl: base+'img/OGD9J14.png',
                // shadowUrl: 'C:/xampp_bkp/htdocs/spatie-saas/public/img/OGD9J14.png',
                iconSize: [100, 70],
                shadowSize: [50, 64],
                iconAnchor: [0, 0],
                shadowAnchor: [4, 62],
                popupAnchor: [0, 0]
            }
        });
        // console.log('poçaa')

        // return false;
        // var count = 1;
        // var veiculo = $('.monitorar_todos_veiculo').attr('veiculo')
        var map = L.map('mapAll').setView([-8.122895, -34.918538], 17);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            minZoom: 8,
            maxZoom: 19
        }).addTo(map);
        var Response = $('#AreaDadosAjaxMonitoramento')
        $.ajax({
            type: 'get',
            url: '/localizacao/monitorar/veiculos/realtime/index',
            success: function (response) {
                Response.html('')
                Response.html(response)
            },
            error: function (response) {
                console.log(response)
            }
        })

        $.ajax({
            type: 'get',
            url: '/localizacao/monitorar/veiculos/realtime/maps/index',
            success: function (response) {
                $(response.dados).each(function (i, e) {
                    var markerGroup = L.featureGroup([]).addTo(map);
                    var latLng = L.latLng([e.latitude, e.longitude]);
                    var greenIcon = new LeafIcon({ iconUrl: base + 'img/OGD9J14.png' });
                    L.marker(latLng, { icon: greenIcon })
                        // L.marker(latLng)
                        // .bindPopup('Placa: ' + e.placa +
                        .bindPopup('Placa: ' + e.placa + '<br>Endreço: ' + e.endereco + ' <br>Atualização local: ' + e.updateLocal)
                        .addTo(markerGroup).addTo(map);
                })
            },
            error: function (response) {
                console.log(response)
            }
        })

        setInterval(function () {
            $.ajax({
                type: 'get',
                url: '/localizacao/monitorar/veiculos/realtime/index',
                success: function (response) {
                    // var dados = response.msg.dados
                    // console.log(response)
                    Response.html('')
                    Response.html(response)
                },
                error: function (response) {
                    console.log(response)
                }
            })

            $.ajax({
                type: 'get',
                url: '/localizacao/monitorar/veiculos/realtime/maps/index',
                success: function (response) {
                    // console.log(response)
                    // var  map = L.map('map').setView([ response.dados[0].latitude,response.dados[0].longitude], 17);
                    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    //   attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    //   minZoom: 1,
                    //   maxZoom: 30
                    // }).addTo(map);
                    $(response.dados).each(function (i, e) {
                        var markerGroup = L.featureGroup([]).addTo(map);
                        var latLng = L.latLng([e.latitude, e.longitude]);
                        var greenIcon = new LeafIcon({ iconUrl: base + 'img/OGD9J14.png' });
                        // L.marker(latLng)
                        // .bindPopup('Placa: ' + e.placa +
                        L.marker(latLng, { icon: greenIcon }).addTo(map).bindPopup('Placa: ' + e.placa + '<br>Endreço: ' + e.endereco + ' <br>Atualização local: ' + e.updateLocal)
                            .addTo(markerGroup).addTo(map);
                    })
                },
                error: function (response) {
                    console.log(response)
                }
            })
            // console.log(count++)
        }, 1000 * 60 * 3);// 3 minutos
        // }, 1000*60*5);// 5 minutos
        // }, 500);//1 segundo
    }


    // MONITORAR ENTREGA
var marker, circle, lat, long;
var entrega = $('.monitorar_entrega').attr('entrega')
    function getPosition(position) {
        // console.log(position)
        lat = position.coords.latitude
        long = position.coords.longitude
        var accuracy = position.coords.accuracy
        // console.log(lat, long, accuracy)

        if(marker){
            map.removeLayer(marker)
        }
        if(circle){
            map.removeLayer(circle)
        }
        marker = L.marker([lat, long])
        circle = L.circle([lat,long],{radius:accuracy})

         L.featureGroup([marker, circle]).addTo(map)
        // map.fitBounds(featureGroup.getBounds())
    }
// MONITORAR ENTREGA
    // if ($('div').hasClass('monitorar_entrega')) {
    //     var map = L.map('mapEntrega').setView([-8.122895, -34.918538], 15);
    //     var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    //         minZoom: 8,
    //         maxZoom: 19
    //     })
    //     osm.addTo(map);

    //     if (!navigator.geolocation) {
    //         console.log('erro. não ativo a localizacao')
    //     } else {
    //         console.log('localizacao ativa')
    //         setInterval(()=>{
    //             navigator.geolocation.getCurrentPosition(getPosition)
    //             if(lat != undefined || long != undefined){
    //                 // console.log(lat,long)
    //                 $.ajax({
    //                     type: 'get',
    //                     url: '/localizacao/monitorar/entrega/' + entrega + '/maps',
    //                     // url: '/localizacao/monitorar/' + veiculo + '/realtime',
    //                     success: function (response) {

    //                         console.log(response)
    //                         // var markerGroup = L.featureGroup([]).addTo(map);
    //                         // var latLng = L.latLng([lat, long]);
    //                         // // // L.marker(latLng)
    //                         // var greenIcon = new LeafIcon({ iconUrl: base + 'img/OGD9J14.png' });
    //                         // L.marker(latLng,{icon:greenIcon}).addTo(map).bindPopup('Placa: ' +  response.dados.placa +'<br>Endreço: ' + response.dados.endereco +' <br>Atualização local: '+response.dados.updateLocal)
    //                         // var userMarker = L.marker(latLng).addTo(map)
    //                         $(response.destinos).each(function (i, e) {
    //                             // console.log(e)
    //                             if (e.destinatario.coordenadas.lat != undefined) {
    //                                 var latLngDest = L.latLng([e.destinatario.coordenadas.lat, e.destinatario.coordenadas.lng]);
    //                                 L.marker(latLngDest)
    //                                     .addTo(map);
    //                                 L.Routing.control({
    //                                     waypoints: [
    //                                         L.latLng([lat, long]),
    //                                         L.latLng(latLngDest)
    //                                     ],
    //                                     // waypointMode:'connect',
    //                                     // fitSelectedRoutes:'smart',
    //                                     // showAlternatives:true,
    //                                     // routeWhileDragging: true,
    //                                 }).addTo(map);
    //                             }else{
    //                                 console.log('Cep Incorreto')
    //                             }
    //                         });
    //                     },
    //                     error: function (response) {
    //                         console.log(response)
    //                     }
    //                 })
    //             }
    //         },5000);
    //     }

        // return
        // var LeafIcon = L.Icon.extend({
        //     options: {
        //         // shadowUrl: base+'img/OGD9J14.png',
        //         // shadowUrl: 'C:/xampp_bkp/htdocs/spatie-saas/public/img/OGD9J14.png',
        //         iconSize: [100, 70],
        //         shadowSize: [50, 64],
        //         iconAnchor: [0, 0],
        //         shadowAnchor: [4, 62],
        //         popupAnchor: [0, 0]
        //     }
        // });
        // var count = 1;
    //     var veiculo = $('.monitorar_entrega').attr('veiculo')
    //     // Iniciar o mapa com coordenadas do ponto A



    //     $.ajax({
    //         type: 'get',
    //         url: '/localizacao/monitorar/' + veiculo + '/entrega/maps',
    //         // url: '/localizacao/monitorar/' + veiculo + '/realtime',
    //         success: function (response) {

    //             // console.log(response)
    //             // var markerGroup = L.featureGroup([]).addTo(map);
    //             var latLng = L.latLng(coordUser);
    //             // // L.marker(latLng)
    //             var greenIcon = new LeafIcon({ iconUrl: base + 'img/OGD9J14.png' });
    //             // L.marker(latLng,{icon:greenIcon}).addTo(map).bindPopup('Placa: ' +  response.dados.placa +'<br>Endreço: ' + response.dados.endereco +' <br>Atualização local: '+response.dados.updateLocal)
    //             var userMarker = L.marker(latLng).addTo(map)
    //             // .bindPopup('Placa: ' +  response.dados.placa +'<br>Endreço: ' + response.dados.endereco +' <br>Atualização local: '+response.dados.updateLocal)
    //             // .addTo(markerGroup)
    //             // .addTo(map);
    //             // L.Routing.control({
    //             //     waypoints: [
    //             //       L.latLng(coordUser),
    //             //     ]
    //             // }).addTo(map);
    //             $(response.destinos).each(function (i, e) {
    //                 if (e.destinatario.coordenadas.lat != undefined) {
    //                     var latLngDest = L.latLng([e.destinatario.coordenadas.lat, e.destinatario.coordenadas.lng]);
    //                     // console.log(latLngDest)
    //                     L.marker(latLngDest)
    //                         .addTo(map);
    //                     L.Routing.control({
    //                         waypoints: [
    //                             L.latLng(coordUser),
    //                             L.latLng(latLngDest)
    //                         ],
    //                         // waypointMode:'connect',
    //                         // fitSelectedRoutes:'smart',
    //                         // showAlternatives:true,
    //                         // routeWhileDragging: true,
    //                     }).addTo(map);
    //                 }
    //             });

    //             // setTimeout(function () {
    //             //     userMarker.setLatLng([lat, lng]);
    //             //     // Identifica o final da viagem.
    //             //     // if (coord.lat === coordUser[0] && coord.lng === coordUser[1]) {
    //             //     //     alert('Seu táxi acabou de chegar!')
    //             //     // }
    //             //     console.log('move user position: ')
    //             //     console.log([lat, lng])
    //             // }, 1000)


    //         },
    //         error: function (response) {
    //             console.log(response)
    //         }
    //     })
    //     // var  map = L.map('map').setView([ -8.122895,-34.918538], 17);
    //     //         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     //           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    //     //           minZoom: 1,
    //     //           maxZoom: 19
    //     //         }).addTo(map);
    //     setInterval(function () {

    //         // console.log('teste')

    //         // console.log(count++)
    //     }, 1000 * 60 * 3);// 3 minutos
    //     // }, 1000*60*5);// 5 minutos
    //     // }, 500);//1 segundo
    //     // }, 1000);//1 segundo
    // }

    //MANUTENCAO
    $('form[name="FormNovaManutencao"]').submit(function () {

        // console.log($(this).serialize())

        $.ajax({
            'url': $(this).attr('action'),
            'data': $(this).serialize(),
            'type': 'post',
            beforeSend: function () {

            },
            success: function (response) {
                console.log(response)
                // return false
                if (response.status == 200) {

                    $('input[name="SalvarNovaManutencao"]').attr('disabled', true)
                    $('#AcoesFomrManutencao').append('<a href="" class="btn btn-primary add_servico_manutencao mx-2" manutencao=' + response.msg.manutencao + '><i class="fa-regular fa-square-plus"></i> Add Serviço</a>');
                    $('#AcoesFomrManutencao').append('<a href="" class="btn btn-success finalizar_form_manutencao mx-2">Finalizar</a>');

                    return false
                }

                if (response.status == 0) {
                    console.log('erro: ' + response.msg)

                    return false;
                }
            },
            error: function () {

            }

        })

        return false;
    })

    $(document).on('click', '.add_servico_manutencao', function () {
        console.log('adicionando novo servico nessa manutencao')

        var IncludeResponseAjax = $('#IncludeResponseAjax')
        $.ajax({
            type: 'get',
            url: '/add-servico-manutencao/' + $(this).attr('manutencao'),
            success: function (response) {
                console.log($('.add_servico_manutencao').attr('manutencao'));
                // return false;
                IncludeResponseAjax.html(response)
                IncludeResponseAjax.show()
            },
            error: function (response) {
                console.log(response)
            }
        })
        // console.log(response)

        return false;
    })

    $(document).on('click', '.finalizar_form_manutencao', function () {
        console.log('finalizando formulario')
        window.location.href = '/manutencao'
        return false;
    })
    $(document).on('submit', 'form[name="FormAddServicoManutencao"]', function () {
        var IncludeResponseAjax = $('#IncludeResponseAjax')
        $.ajax({
            'url': $(this).attr('action'),
            'data': $(this).serialize(),
            'type': 'post',
            beforeSend: function () {

            },
            success: function (response) {

                console.log(response)
                IncludeResponseAjax.html('')
                IncludeResponseAjax.hide()
            },
            error: function () {

            }

        })
        return false
    })

    $('form[name="FormSearch"]').submit(function(){
        var InputSearch = $('input[name="search"]');
        if(InputSearch.val()=="" || InputSearch.val()== undefined){
            alert('Digite no campo de busca para pesquisar')
            InputSearch.focus()
            return false
        }

        $.ajax({
            'url': $(this).attr('action'),
            'data': $(this).serialize(),
            'type': 'post',
            beforeSend: function () {

            },
            success: function (response) {
                $('#ResponseSearchAjax').show()
                $("#TextSearch").text(InputSearch.val())
                $('.response_search_ajax').html('')
                $('.response_search_ajax').html(response)
                // console.log(response)
                // window.location.href= '/search';
                // IncludeResponseAjax.html('')
                // IncludeResponseAjax.hide()
            },
            error: function () {

            }

        })
        return false;
    })
    // if($('div').hasClass('response_search_ajax')){
    //     alert('ola')
    // }
    $('.close-result-searach').click(function(){
        $('#ResponseSearchAjax').hide()
        return false;
    })
});

// function msgEncerramento() {
//     alert('Seu tempo acabou!! Tente novamente!!');
//     }
//     setTimeout(msgEncerramento, 3000)

