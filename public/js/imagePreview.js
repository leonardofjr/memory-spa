

$uploadCrop = $('#uploadDemo').croppie({
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

$('#profile_image').on('change', function() {
    var reader = new FileReader();
    reader.onload = function(event) {
        $uploadCrop.croppie('bind', {
            url: event.target.result
        }).then(function() {
            openCroppieModal() 
            console.log('Jquery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
})

function openCroppieModal() {
    $("#croppieModal").modal();
}