
$(document).ready(function () {

class BasicValidation {
    constructor() {
        this.fields = [];
    }

    addField(ele, field) {
        if (field) {
            this.fields.push({
                field: field[0],
                ele: ele
            });
        }
    }

    init(ele) {
        this.hide(ele);
        this.validate();
    }

    hide(ele) {
        $(ele).addClass('d-none');
    }

    validate() {
        this.fields.forEach(function (item, i) {
            $(item.ele).removeClass('d-none');
            $(item.ele).html(item.field);
        })
    }
}

    $('#addWorkForm, #editWorkForm').submit(function () {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'json',
            data: $(this).serialize(),

            success: function (data, status) {
                if (status === 'success') {
                    $('.flash-message-success').removeClass('d-none');
                }
            },
            error: function (err) {
                console.log(err.responseJSON.errors)
                let validation = new BasicValidation();
                validation.addField('.error-title', err.responseJSON.errors.title);
                validation.addField('.error-description', err.responseJSON.errors.description);
                validation.addField('.error-type', err.responseJSON.errors.type);
                validation.addField('.error-file', err.responseJSON.errors.file_1);
                validation.addField('.error-website-url', err.responseJSON.errors.website_url);
                validation.init('.error');


            }
        });

        return false;
    });


    $('#gallery-upload-form').submit(function () {
        var formData = new FormData($('#gallery-upload-form')[0]);
        if ($('#gallery-overlay-checkbox').attr('data-id')) {
            formData.set('gallery-overlay-checkbox', $('#gallery-overlay-checkbox').attr('data-id'));
        }
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-Token': $('[name="_token"]').val()
            },
            data: formData,

            success: function (data, status) {
                if (status === 'success') {
                    console.log(data);
                    location.href = '/admin/user-panel/gallery/';
                }
            },
            error: function (xhr, status, err) {
                response = err.responseJSON;
                console.log(xhr.responseText);
            }
        });

        return false;
    });




});
