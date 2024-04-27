    $(function(){
        var base = 'http://localhost:8000/';
        var routeStorePermission = base+'permissions';

        // alert(routeStorePermission)
        $('form[name="formAddPermissao"]').submit(function(){
            // alert($(this).serialize())
            $.ajax({
                url: routeStorePermission,
                type:"post",
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend:function(){
                    // alert(routeStorePermission)
                },
                success:function(response){
                    console.log(response)
                },
                error:function(response){
                    alert(response)
                }
            });

            return false
        });

    });
