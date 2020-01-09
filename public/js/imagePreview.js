$uploadCrop = $('#uploadDemo').croppie({
    enableExif: true,
    viewport: {
        width: 500,
        height: 500,
        type: 'square'
    },
    boundary: {
        width: 600,
        height: 600
    }
});

$('#profile_image').on('change', function() {
    var reader = new FileReader();

    reader.onload = function(event) {

        openCroppieModal();
        
        $uploadCrop.croppie('bind', {
            url : event.target.result
        }).then(function() {
            console.log('Jquery Bind Completed!')
        })
    }

    reader.readAsDataURL(this.files[0]);
})




$('#cropBtn').on('click', function() {
    $uploadCrop.croppie('result', {
        'type' : 'canvas',
        'size' : 'viewport',
    }).then(function(result) {
        closeCroppieModal();
        ajaxUpload(result)
    })
})

function ajaxUpload(result) {
    const settings = {
        url : '/upload-cropped-image',
        method : 'post',
        type : 'json',
        headers: {
            'X-CSRF_TOKEN' : $('meta[name="csrf-token"]').attr('content'),
        },
        data: {
            'image' : result
        },
    }

    $.ajax(settings)
    .done(function(response) {
        console.log(response)
    })
    .fail(function(err) {
        console.log(err);
    })
}



function openCroppieModal() {
    $("#croppieModal").modal();
}

function closeCroppieModal() {
    $("#croppieModal").modal('hide');
}