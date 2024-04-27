    $(function(){
        var base = 'localhost:8000/';
        var routeStorePermission = base+'permissions/store';

        // alert(routeStorePermission)
        $('form[name="formAddPermissao"]').submit(function(){

            $.ajax({
                url: routeStorePermission,
                // method:'post',
                type:'post',
                data:$(this).serialize(),
                beforeSend:function(){
                    alert($(this).serialize())
                },
                success:function(response){
                    alert(response.msg)
                },
                error:function(response){
                    alert(response)
                }
            });

            return false
        });

    });
