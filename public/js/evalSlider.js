    function evalSlider(id) {
        let sliderValue = $('#' + id).val();
         $('#' + id ).next().html(sliderValue);
    }
