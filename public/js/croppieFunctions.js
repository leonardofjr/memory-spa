
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
    $(logoPreviewElement).attr('src', data.tempDirectory + data.filename )
    $(logoPreviewElement).show();
}


function openCroppieModal() {
    $(croppieModal).modal();
}

function closeCroppieModal() {
    $(croppieModal).modal('hide');
}


function imageReset() {
    $(uploadedImageElement).val('');
    $(logoPreviewElement).attr('src', '');
}

$(croppieModalCloseBtn).on('click', function() {
    imageReset();
})