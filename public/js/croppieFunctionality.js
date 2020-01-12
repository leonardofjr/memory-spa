const uploadDemoElement = $('#uploadDemo');
const uploadedImageElement = $('#uploadedImageFile');
const imageFilePreviewElement = $('#imageFilePreview');
const cropBtnElement = $('#cropBtn');
const croppieModal = $('#croppieModal');
const croppieModalCloseBtn = $('.close, .closeBtn');
const csrfTokenElement = $('meta[name="csrf-token"]').attr('content');
let currentImage = imageFilePreviewElement.attr('src');


$uploadCrop = $(uploadDemoElement).croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


/*** Croppie {Settings Page} Setup  ***/

$(uploadedImageElement).on('change', function() {
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




$(cropBtnElement).on('click', function() {
    $uploadCrop.croppie('result', {
        'type' : 'canvas',
        'size' : { width: 500, height: 500 },
    }).then(function(result) {
        closeCroppieModal();
        ajaxUpload(result)
    })
})



/*** AJAX ***/



function ajaxUpload(result) {
    /* AJAX Settings */

    const uploadImageAjaxSettings = {
        url : '/upload-cropped-image',
        method : 'post',
        type : 'json',
        headers: {
            'X-CSRF_TOKEN' : csrfTokenElement,
        },
        data: {
            'image' : result
        },
    };

    $.ajax(uploadImageAjaxSettings)
    .done(function(response) {
        updateImagePreview(response);
    })
    .fail(function(err) {
        console.log(err);
    })
}


/*** FUNCTIONS ***/

function updateImagePreview(data) {
    $(imageFilePreviewElement).attr('src', data.tempDirectory + data.filename )
    $(imageFilePreviewElement).show();
}


function openCroppieModal() {
    $(croppieModal).modal();
}

function closeCroppieModal() {
    $(croppieModal).modal('hide');
}


function imageReset() {
    $(uploadedImageElement).val('');
}

$(croppieModalCloseBtn).on('click', function() {
    imageReset();
})