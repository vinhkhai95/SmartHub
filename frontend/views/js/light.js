function switchLight(element){
    var id = jQuery(element).parent().parent().parent().parent().attr('id');
    if ($('#'+id+' .cube-switch').hasClass('active')) {
        $('#'+id+' .cube-switch').removeClass('active');
        $('#'+id+' .light-bulb-on').css({'opacity': '0'});
    } else {
        $('#'+id+' .cube-switch').addClass('active');
        $('#'+id+' .light-bulb-on').css({'opacity': '1'});
    }
}