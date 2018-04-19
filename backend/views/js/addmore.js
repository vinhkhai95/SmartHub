function addmore_light(element) {
    var lab_id = jQuery('#lab_id').val();
    lab_id = parseInt(lab_id);
    var id = jQuery(element).parent().parent().parent().parent().parent().parent().parent().parent(".col-lg-4").attr('id');
    var html = '<div class="light-bulb-off off ui-draggable" id="'+id+'">';
        html +='<div class="light-bulb-on" style="opacity: 0;"></div>';
        html +='</div>';
    $("#"+id).append(html);
    publish(topicLatchDevice+id, "1");
    $.ajax({
            url : "index.php?action=lab_update_device",
            type : "post",
            dataType:"text",
            data : {device_value : id, lab_id: lab_id, value: 'light'},
            success: function () {
                window.location.reload();
            }
    });
}
function addmore_fan(element) {
    var lab_id = jQuery('#lab_id').val();
    lab_id = parseInt(lab_id);
    var id = jQuery(element).parent().parent().parent().parent().parent().parent().parent().parent(".col-lg-4").attr('id');
    var html = '<div id="fan'+id+'">';
        html +='<img class="img" src="../pictures/fan.jpg">';
        html +='</div>';
    $("#"+id).append(html);
    publish(topicLatchDevice+id, "1");
    $.ajax({
            url : "index.php?action=lab_update_device",
            type : "post",
            dataType:"text",
            data : {device_value : id, lab_id: lab_id, value: 'fan'},
            success: function () {
                window.location.reload();
            }
    });
}
function addmore_air(element) {
    var lab_id = jQuery('#lab_id').val();
    lab_id = parseInt(lab_id);
    var id = jQuery(element).parent().parent().parent().parent().parent().parent().parent().parent(".col-lg-4").attr('id');
    var html = '<div id="air'+id+'">';
        html +='<img class="img" src="../pictures/air.jpg">';
        html +='</div>';
    $("#"+id).append(html);
    publish(topicLatchDevice+id, "1");
    $.ajax({
            url : "index.php?action=lab_update_device",
            type : "post",
            dataType:"text",
            data : {device_value : id, lab_id: lab_id, value: 'air'},
            success: function () {
                window.location.reload();
            }
    });
}