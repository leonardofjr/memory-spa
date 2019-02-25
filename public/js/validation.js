
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
        let formData = new FormData($(this)[0]);
        console.log(formData.get('file_1').name);
        if (formData.get('file_1').name == "") {
            formData.delete('file_1');
        }
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,

            success: function (data, status) {
                location.href = data.redirect;
            },
            error: function (err) {
                console.log(err)
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
    $('#setupPageForm').submit(function () {

        // Fix to save textarea field value using CKEDITOR
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        // Storing Form data into variable
        let formData = new FormData($(this)[0]);

        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            success: function (data, status) {
                location.href = data.redirect;
            },
            error: function (err) {
                console.log(err);
                let validation = new BasicValidation();
                validation.addField('.error-bio', err.responseJSON.errors.bio);
                validation.init('.error');
            }
        });

        return false;
    });





});
