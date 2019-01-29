    function evalSlider(id) {
        console.log(id);
        let sliderValue = $('#' + id).val();
         $('#' + id ).next().html(sliderValue);
    }
