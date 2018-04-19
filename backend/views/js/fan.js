$(document).ready(function(){
	$("#add_fan").click(function(){
        var lab_id = jQuery('#lab_id').val();
        lab_id = parseInt(lab_id);
        var count = jQuery('#count').val();
        count = parseInt(count);
        count = count + 1;
        jQuery('#count').val(count);
        var html = '<div class="col-lg-4" id="device'+count+'">';
	        html +='<div class="form-group">';
	        html +='<div class="text">device'+count+'</div>';
	        html +='<div onclick="switchFan(this)">';
	        html +='<div class="cube-switch3">';
	        html +='<span class="switch3">';
	        html +='<span class="switch-state3 off3">Off</span>';
	        html +='<span class="switch-state3 on3">On</span>';
	        html +='</span>';
	        html +='</div>';
	        html +='</div>';
	        html +='<input type="button" class="w3-button w3-black" value="delete" onclick="deleteFan(this)" name="delete">';
	        html +='<div><img class="img" src="../pictures/fan.jpg" id="1device'+count+'"></div>';
	        html +='</div>';
	        html +='</div>';
        $("#add_field").append(html);
        $.ajax({
            url : "index.php?action=lab_add_device",
            type : "post",
            dataType:"text",
            data : {device_value : 'device'+count, lab_id: lab_id, value: "fan",count: count},
            success: function (responsse) {
                window.location.reload();       
            }
        });
    })
});
function deleteFan(element){
    var lab_id = jQuery('#lab_id').val();
    lab_id = parseInt(lab_id);
    var id = $(element).parent().parent().parent(".col-lg-4").attr('id');
    $("#fan"+id).hide();
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
