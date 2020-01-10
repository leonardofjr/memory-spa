/*** CONSTANTS ***/

/* Elements */

const profileImageElement = $('#profileImage');
const logoPreviewElement = $('#logoPreview');
const uploadDemoElement = $('#uploadDemo');
const cropBtnElement = $('#cropBtn');
const croppieModal = $('#croppieModal');
const croppieModalCloseBtn = $('.close, .closeBtn');
const csrfTokenElement = $('meta[name="csrf-token"]').attr('content');


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

$(profileImageElement).on('change', function() {
    var reader = new FileReader();

    reader.onload = function(event) {

        openCroppieModal('#croppieModal');

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
        'size' : {width: 500, height: 500},
    }).then(function(result) {
        closeCroppieModal();
        ajaxUpload(result)
    })
})


/*** FUNCTIONS ***/


function ajaxUpload(result) {
    const settings = {
        url : '/upload-cropped-image',
        method : 'post',
        type : 'json',
        headers: {
            'X-CSRF_TOKEN' : csrfTokenElement,
        },
        data: {
            'image' : result
        },
    }

    $.ajax(settings)
    .done(function(response) {
        updateImagePreview(response);
    })
    .fail(function(err) {
        console.log(err);
    })
}

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
    $(profileImageElement).val('');
    $(imagePreview).attr('src', '');
}

$(croppieModalCloseBtn).on('click', function() {
    imageReset();
})