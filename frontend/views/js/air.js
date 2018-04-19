function switchAir(element){
    var id = jQuery(element).parent().parent().parent().parent().attr('id');
    if ($('#'+id+' .cube-switch3').hasClass('active3')) {
        $('#'+id+' .cube-switch3').removeClass('active3');
    } else {
        $('#'+id+' .cube-switch3').addClass('active3');
    }
}