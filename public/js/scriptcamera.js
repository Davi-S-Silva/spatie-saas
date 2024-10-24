$(document).ready(function(){
    var video = document.querySelector("video");
    var CameraFotoCupom = $('#CameraFotoCupom');
    var CameraFotoBomba = $('#CameraFotoBomba');
    var CameraFotoHodometro = $('#CameraFotoHodometro');
    CameraFotoCupom.css({})
    var VideoCameraAbastecimento = $('.video_camera_abastecimento')
    var AreaCameraAbastecimento = $('#AreaCameraAbastecimento')

    CameraFotoCupom.click(function(){
        // alert('ola mundo')
        AreaCameraAbastecimento.show()
        CameraCanvas = $(this).attr('id')
        // AreaCamera.removeClass('d-none')

        navigator.mediaDevices
        .getUserMedia({
            video: {
                facingMode: { exact: "user" },
                width:900,
                height:900
            }
        })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
        })
        .catch((error) => {
            console.log(error);
        });

    })

    CameraFotoBomba.click(function(){
        // alert('ola mundo')
        AreaCameraAbastecimento.show()
        CameraCanvas = $(this).attr('id')
        // AreaCamera.removeClass('d-none')

        navigator.mediaDevices
        .getUserMedia({
            video: {
                facingMode: { exact: "environment" },
                width:900,
                height:900
            }
        })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
        })
        .catch((error) => {
            console.log(error);
        });

    })
    CameraFotoHodometro.click(function(){
        // alert('ola mundo')
        AreaCameraAbastecimento.show()
        CameraCanvas = $(this).attr('id')
        // AreaCamera.removeClass('d-none')

        navigator.mediaDevices
        .getUserMedia({
            video: {
                facingMode: { exact: "environment" },
                width:900,
                height:900
            }
        })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
        })
        .catch((error) => {
            console.log(error);
        });

    })



    document.querySelector("#btnTirarFoto").addEventListener("click", (e) => {
        // var canvas = document.querySelector("canvas");
        e.preventDefault();
        var canvas = document.querySelector('#Canvas'+CameraCanvas)
        AreaCameraAbastecimento.hide()
        $('#Canvas'+CameraCanvas).removeClass('d-none');
        // alert(canvas.getAttribute('id'))
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        var context = canvas.getContext("2d");
        context.drawImage(video, 0, 0);
        var link = document.createElement('a');
        // var link = document.querySelector("a");
        link.id="LinkImg"+CameraCanvas;
        link.download=CameraCanvas+'.png';
        link.href = canvas.toDataURL();
        link.textContent = "Baixar";
        var name =$('#'+CameraCanvas).attr('name')
        // document.body.appendChild(link);
        $('#AreaFoto'+name).append(link);
        var inputHidden = '<input type="hidden" value="'+canvas.toDataURL()+'" name="Foto'+name+'"/>'
        $('#AreaFoto'+name).append(inputHidden);
        // alert(link.href)
        video.srcObject.getTracks().forEach(element => {
            element.stop();
        });
    });
})
