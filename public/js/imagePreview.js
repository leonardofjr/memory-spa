class ImagePreview {
    constructor(element, target) {
        this.input = element;
        this.target = target;
    }

    init() {
        this.process(this.target);
    }

    process(target) {
        // Getting Image From Input
        if (this.input.files && this.input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(target)
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(this.input.files[0]);

        }
    }

}

function previewImageToUpload(image, target) {
    let imagePreview = new ImagePreview($('#' + image)[0], '#' + 'imgPreview');
    imagePreview.init();
}