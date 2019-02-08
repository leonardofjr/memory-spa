/* This slider is used to update the Skills Range Input, it'll display the output value */
function evalSlider(id) {
    let sliderValue = $('#' + id).val();
        $('#' + id ).next().html(sliderValue);
}
