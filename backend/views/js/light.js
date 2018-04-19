$(document).ready(function(){
    $("#add_light").click(function(){
        var lab_id = jQuery('#lab_id').val();
        lab_id = parseInt(lab_id);
        var count = jQuery('#count').val();
        count = parseInt(count);
        count = count + 1;  
        jQuery('#count').val(count);
        var html = '<div class="col-lg-4" id="device'+count+'">';
        html += '<div class="form-group">';
        html += '<div class="text">device'+count+'</div>';
        html +='<div onclick="switchLight(this)">';
        html += '<div class="cube-switch">';
        html += '<span class="switch" >';
        html += '<span class="switch-state off">Off</span>';
        html += '<span class="switch-state on">On</span>';
        html += '</span>';
        html += '</div>';
        html +='</div>';
        html += '<input type="button" class="w3-button w3-black" value="delete" onclick="deleteLight(this)">';
        html += '<div class="light-bulb-off off ui-draggable" >';
        html += '<div class="light-bulb-on" style="opacity: 0; "></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $("#add_field").append(html);
        $.ajax({
            url : "index.php?action=lab_add_device",
            type : "post",
            dataType:"text",
            data : {device_value : 'device'+count, lab_id: lab_id, value: "light",count: count},
            success: function (responsse) {
                window.location.reload();
            }
        });
    })
});
function deleteLight(element){
    var lab_id = jQuery('#lab_id').val();
    lab_id = parseInt(lab_id);
    var id = $(element).parent().parent().parent(".col-lg-4").attr('id');
    $("#light"+id).hide();
    $.ajax({
        url : "index.php?action=lab_delete_device",
        type : "post",
        dataType:"text",
        data : {device_value : id, lab_id: lab_id},
        success: function(responsse) {
            window.location.reload();
        }
    });
}
