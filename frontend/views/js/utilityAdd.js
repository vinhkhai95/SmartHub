//Create a client instance
client = null;
connected = false;
var topicControlDevice  = "Room"+room_id+switchControl;  //"Room1/remote/"
var topicTemp           = "Room"+room_id+Temp;
var topicPir            = "Room"+room_id+Pir;
var topicLightSensor    = "Room"+room_id+Light;


//For IR features
var topicControlAC       = "Room"+room_id+ACControl;
var topicControlPR       = "Room"+room_id+PRControl;
var topicIRLearning      = "Room"+room_id+IRLearning;
var topicIRLearningACK   = "Room"+room_id+IRLearningACK;
var topicIRButtonList    = "Room"+room_id+IRButtonList;
var topicIRButtonListACK = "Room"+room_id+IRButtonListACK;

// called when the client connects
function onConnect(context) {
  // Once a connection has been made, make a subscription and send a message.
  console.log("Client Connected");
    if(AllDeviceName != 'NULL'){
      //Duyệt object
      Object.keys(AllDeviceName).forEach(function(key) {
        if(AllDeviceName[key]['value'] != 'NULL'){
      subscribe(topicControlDevice+AllDeviceName[key]['device_value'],1);
    }
});
    }
    subscribe(topicTemp, 1);
    subscribe(topicPir, 1);
    subscribe(topicLightSensor, 1);
    subscribe(topicControlAC, 1);
    subscribe(topicControlPR, 1);
    // subscribe(topicIRLearning, 1);
    subscribe(topicIRLearningACK, 1);
    // subscribe(topicIRButtonList, 1);
    subscribe(topicIRButtonListACK, 1);
  connected = true;
}

function onFail(context) {
  console.log("Failed to connect");
  connected = false;
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    console.log("Connection Lost: " + responseObject.errorMessage);
  }
  connected = false;
}

// called when a message arrives
function onMessageArrived(message) {
  var topic = message.destinationName;
  var payload = message.payloadString;
  var qos = message.qos;
  console.log('Message Recieved: Topic: ', topic, '. Payload: ', payload, '. QoS: ', qos);
  if(topic.indexOf(topicControlDevice) != -1){
    var device_value = topic.substring(13);       //get device number
    var device_id = device_value.substring(6)-1;  //get device id
      //Subscription for light
    if(AllDeviceName[device_id]['value'] == "light"){
      if(payload == "0") checkLightArrived("off", device_value);
      if(payload == "1") checkLightArrived("on", device_value);     
    }
      //Subscription for fan
    if(AllDeviceName[device_id]['value'] == "fan"){
      if(payload == "0") checkFanArrived("off", device_value);
      if(payload == "1") checkFanArrived("on", device_value);     
    }
      //Subscription for fan
    if(AllDeviceName[device_id]['value'] == "air"){
      if(payload == "0") checkAirArrived("off", device_value);
      if(payload == "1") checkAirArrived("on", device_value);     
    }

  }
  if(topic.indexOf(topicControlAC) != -1){   
    checkACArrived(payload);
  }
  if(topic==topicPir){
    //Subscription for human presence
    if(payload == "1" ) checkPirArrived("presence");
    if(payload == "0") checkPirArrived("notpresence");   
  }  
  if(topic==topicLightSensor){
    //Subscription for human presence
    if(payload == "1" ) checkLightSensorArrived("on");
    if(payload == "0") checkLightSensorArrived("off");   
  }

  if(topic==topicTemp){
    //Subscription the temperature
    if(!isNaN(message.payloadString)){
          var point = $('#container-speed').highcharts().series[0].points[0];
          point.update(parseInt(message.payloadString));
      }
  }
  if((topic == topicIRLearningACK)){
    if(payload =="1") {
      close_waiting_popup();
      choose_button_popup();
    }
    else close_waiting_popup();
  }
}

function connect(){
    if(path.length > 0){
      client = new Paho.MQTT.Client(hostname, Number(port), path, clientId);
    } else {
      client = new Paho.MQTT.Client(hostname, Number(port), clientId);
    }
    console.info('Connecting to Server: Hostname: ', hostname, '. Port: ', port, '. Path: ', client.path, '. Client ID: ', clientId);

    // set callback handlers
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    //Set option
        var options = {
      invocationContext: {host : hostname, port: port, path: client.path, clientId: clientId},
      timeout: timeout,
      keepAliveInterval:keepAlive,
      cleanSession: cleanSession,
      useSSL: ssl,
      onSuccess: onConnect,
      onFailure: onFail
    };

    if(user.length > 0){
      options.userName = user;
    }
    if(pass.length > 0){
      options.password = pass;
    }

      // connect the client
        client.connect(options);
}

function disconnect(){
    console.info('Disconnecting from Server');
    client.disconnect();
    var statusSpan = document.getElementById("connectionStatus");
    statusSpan.innerHTML = 'Connection - Disconnected.';
    connected = false;
    setFormEnabledState(false);
}


function publish(topic, message){
    console.info('Publishing Message: Topic: ', topic, '. QoS: ' + qos + '. Message: ', message);
    newMessage = new Paho.MQTT.Message(message);
    newMessage.destinationName = topic;
    newMessage.qos = qos;
    newMessage.retained = retain;
    client.send(newMessage);
}

function publishNoRetain(topic, message){
    console.info('Publishing Message: Topic: ', topic, '. QoS: ' + qos + '. Message: ', message);
    newMessage = new Paho.MQTT.Message(message);
    newMessage.destinationName = topic;
    newMessage.qos = qos;
    newMessage.retained = false;
    client.send(newMessage);
}


function subscribe(topic, qos){
    console.info('Subscribing to: Topic: ', topic, '. QoS: ', qos);
    client.subscribe(topic, {qos: Number(qos)});
}

// Just in case someone sends html
function safe_tags_regex(str) {
   return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

//Publish message when click button
function checkLight(element){
  var id = jQuery(element).parent().parent().parent().parent().attr('id');
  if ($('#'+id+' .cube-switch').hasClass('active')) { publish(topicControlDevice+id,"1");}
  else publish(topicControlDevice+id, "0");
}

function checkFan(element){
  var id = jQuery(element).parent().parent().parent().parent().attr('id');
  if($('#'+id+' .cube-switch3').hasClass('active3')) { publish(topicControlDevice+id,"1");}
  else publish(topicControlDevice+id, "0");
}

function checkAir(element){
  var id = jQuery(element).parent().parent().parent().parent().attr('id');
  if($('#'+id+' .cube-switch3').hasClass('active3')) { publish(topicControlDevice+id,"1");}
  else publish(topicControlDevice+id, "0");
}

function checkIR(element){
  var id = jQuery(element).parent().parent().parent().parent().attr('id');
  var value = jQuery(element).val();
  publish(topicIR, value);
}

//Subscribe topic and change UI state when message arrive
function checkLightArrived(state, id){
  if(state == "off") {
      if ($('#'+id+' .cube-switch').hasClass('active')) {
          $('#'+id+' .cube-switch').removeClass('active');
          $('#'+id+' .light-bulb-on').css({'opacity': '0'});
     }
  }
  else if(state == "on") {
      if (!$('#'+id+' .cube-switch').hasClass('active')) {
          $('#'+id+' .cube-switch').addClass('active');
          $('#'+id+' .light-bulb-on').css({'opacity': '1'});
     }
  }
}

function checkFanArrived(state, id){
  if(state == "off") {
    if ($('#'+id+' .cube-switch3').hasClass('active3')) {
        $('#'+id+' .cube-switch3').removeClass('active3');
        $('#fan'+id).removeClass('rotate');
    }
  }
  else if(state == "on") {
      if (!$('#'+id+' .cube-switch').hasClass('active')) {
          $('#'+id+' .cube-switch3').addClass('active3');
          $('#fan'+id).addClass('rotate');
     }
  }
}

function checkAirArrived(state, id){
  if(state == "off") {
    if ($('#'+id+' .cube-switch3').hasClass('active3')) {
        $('#'+id+' .cube-switch3').removeClass('active3');
    }
  }
  else if(state == "on") {
      if (!$('#'+id+' .cube-switch').hasClass('active')) {
          $('#'+id+' .cube-switch3').addClass('active3');
     }
  }
}

function checkPirArrived(state) {
  if(state == "presence") {
    $('#humanpresence').attr('src','views/pictures/Human.PNG');
    var now = new moment();
    now = now.format("YYYY-MM-DD HH:mm:ss");
    document.getElementById('lastPresence').innerHTML = "Last presence:"+now;
    $.ajax({
        url : "index.php?action=home_add_presence",
        type : "post",
        dataType:"text",
        data : {room_id : room_id, time: now},
        success: function (responsse) { 
        }
    });
  }
  else {
    $('#humanpresence').attr('src','views/pictures/notHuman.PNG');
  }
}

function checkLightSensorArrived(state) {
  if(state == "off") {
    $('#lightsensor').attr('src','../pictures/lightoff.png');
  }
  else if(state == "on") {
    $('#lightsensor').attr('src','../pictures/lighton.jpg');
  }
}


function checkACArrived(button) {
  switch(button) {
    case '1': //ON
      var value= document.getElementById("power-value");
      enable_button("power");
      if(value != null) value.innerHTML = "ON";
      break;
    case '2': //OFF
      var value= document.getElementById("power-value");
      disable_button("power");
      if(value != null) value.innerHTML = "OFF";
      break;
    case '3': //18
        AC_target_temp_set("deg_18");
        break;
    case '4': //20
        AC_target_temp_set("deg_20");
        break;
    case '5': //22
        AC_target_temp_set("deg_22");
        break;
    case '6': //24
        AC_target_temp_set("deg_24");
        break;
    case '7': //26
        AC_target_temp_set("deg_26");
        break;
    case '8': //28
        AC_target_temp_set("deg_28");        
        break;
  }
}



//AC handle
function AC_power_onclick(){
      var elem = document.getElementById("power").className;
      var value= document.getElementById("power-value");
      if(elem == "btn btn-default") {
        publish(topicControlAC, AClist["ON"].toString());
        enable_button("power");
        value.innerHTML = "ON";
      }
      else {
        publish(topicControlAC, AClist["OFF"].toString());
        disable_button("power");
        value.innerHTML = "OFF";
      }
  }


function AC_mode_onclick(mode) {
  AC_mode_reset();
  switch(mode){
    case 1:
      document.getElementById("mode_cooling").className="btn btn-info mode-btn";
      break;
    case 2:
      document.getElementById("mode_dehum").className="btn btn-info mode-btn";
      break;
    case 3:
      document.getElementById("mode_heating").className="btn btn-info mode-btn";
      break;
    case 4:
      document.getElementById("mode_fan").className="btn btn-info mode-btn";
      break;
    case 5:
      document.getElementById("mode_auto").className="btn btn-info mode-btn";
      break;      
    }
}

function AC_mode_reset(){
  var mode_list= document.getElementsByClassName("mode-btn btn-info");
  for(var i=0; i<mode_list.length; ++i){
    mode_list[i].className="btn btn-default mode-btn";
  }
}

function AC_fan_onclick(mode) {
  switch(mode){
    case 1:
      document.getElementById("fan_auto").className="btn btn-info fan-btn";
      break;
    case 2:
      AC_set_fan_img(1);
      break;
    case 3:
      AC_set_fan_img(2);
      break;
    case 4:
      AC_set_fan_img(3);
      break;
    case 5:
      AC_set_fan_img(4);
      break;
    case 6:
      AC_set_fan_img(5);
      break;
  }
}

function AC_set_fan_img(num){
  var temp;
  for(var i=1; i<6; ++i){
    temp = document.getElementById("fan_lvl_" + i.toString());
    if(i <= num){
      temp.src="views/media/level_"+i.toString()+"_on.svg";
    }else{
      temp.src="views/media/level_"+i.toString()+"_off.svg";
    }
  }
}

function AC_target_temp_set(temp) {
  AC_temp_target_reset();
  enable_button(temp);
}

function AC_target_temp_onclick(element) {
  AC_target_temp_set(element.id);
  var temp = element.id.substr(4,5); //cắt lấy nhiệt độ
  publish(topicControlAC, AClist[temp].toString());
}

function AC_temp_target_reset() {
  var temp_list= document.getElementsByClassName("temp-target-btn btn-info");
  for(var i=0; i<temp_list.length; ++i){
    temp_list[i].className="btn btn-default temp-target-btn";
  }
}

function AC_step_temp_onclick(mode) {
  var temp_list = document.getElementsByClassName("temp-target-btn");
  if(mode=="up") {    
    for(var i=0; i<temp_list.length-1; ++i){
      if(temp_list[i].className == "btn temp-target-btn btn-info") {
        var temp_id = temp_list[i+1].id;
        publish(topicControlAC, AClist[temp_id.substr(4,5)].toString());        
        AC_target_temp_set(temp_id);
        break;
      }
    }
  }
  if(mode=="down") {
    for(var i=1; i<temp_list.length; ++i){
      if(temp_list[i].className == "btn temp-target-btn btn-info") {
        var temp_id = temp_list[i-1].id;
        publish(topicControlAC, AClist[temp_id.substr(4,5)].toString());        
        AC_target_temp_set(temp_id);
        break;
      }
    }
  }
}

function AC_get_button_learning(){
  var x = document.getElementById("ACPowerButtonList").selectedIndex;
  var y = document.getElementById("ACPowerButtonList").options;  
  var button = y[x].index;
  close_choose_button_popup();
  console.log(button);
  publishNoRetain(topicIRButtonList, button.toString());
}

function AC_learning_onclick(){
  enable_button("learning");
  publishNoRetain(IRLearning, "1");
  waiting_popup();
}

function waiting_popup(){
var popup = document.getElementById('waitingPopup');
    popup.style.display = "block";
}
function waiting_popup_menu(){
    var popup = document.getElementById('ChooseButtonPopup');
    popup.style.display = "block";
}

function close_waiting_popup(){
  disable_button("learning");
  var popup = document.getElementById('waitingPopup');
      popup.style.display = "none";
}

function choose_button_popup(){
var popup = document.getElementById('ChooseButtonPopup');
    popup.style.display = "block";
}

function close_choose_button_popup(){
  var popup = document.getElementById('ChooseButtonPopup');
     popup.style.display = "none";
}

function enable_button(id) {
  var elem = document.getElementById(id);
  if(elem != null){
    if(elem.classList.contains("btn-default")) {
    elem.classList.remove("btn-default");
    elem.classList.add("btn-info");
    }
  }
}

function disable_button(id) {
  var elem = document.getElementById(id);
  if(elem != null){
    if(elem.classList.contains("btn-info")) {
    elem.classList.remove("btn-info");
    elem.classList.add("btn-default");
    }
  }
}
connect();