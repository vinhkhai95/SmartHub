//Create a client instance
client = null;
connected = false;
var topicControlDevice = "Room"+room_id+remoteControl;  //"Room1/remote/"
console.log(AllDeviceName);

// called when the client connects
function onConnect(context) {
  // Once a connection has been made, make a subscription and send a message.
  console.log("Client Connected");
    if(AllDeviceName != null){
      //Duyệt object
      Object.keys(AllDeviceName).forEach(function(key) {
      subscribe(topicControlDevice+AllDeviceName[key]['device_value'],1);
});
    }
    subscribe(Temp, 1);
    subscribe(Pir, 1);
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
    var device_value = topic.substring(13);
    var device_id = device_value.substring(6)-1;

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
  }

  //Subscription for human presence
  if(payload == "P1" ) checkPirArrived("presence");
  if(payload == "P0") checkPirArrived("notpresence");

  //Subscription the temperature
  if(!isNaN(message.payloadString)){
        var point = $('#container-speed').highcharts().series[0].points[0];
        point.update(parseInt(message.payloadString));
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
    // var qos = 0;
    // var retain = true;
    console.info('Publishing Message: Topic: ', topic, '. QoS: ' + qos + '. Message: ', message);
    newMessage = new Paho.MQTT.Message(message);
    newMessage.destinationName = topic;
    newMessage.qos = qos;
    newMessage.retained = retain;
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

//Change device state when click button
function switchLight(element){
    var id = jQuery(element).attr('id');
    if ($('#'+id+' .cube-switch').hasClass('active')) {
        $('#'+id+' .cube-switch').removeClass('active');
        $('#'+id+' .light-bulb-on').css({'opacity': '0'});
    } else {
        $('#'+id+' .cube-switch').addClass('active');
        $('#'+id+' .light-bulb-on').css({'opacity': '1'});
    }
}
function switchFan(element){
    var id = jQuery(element).attr('id');
    if ($('#'+id+' .cube-switch3').hasClass('active3')) {
        $('#'+id+' .cube-switch3').removeClass('active3');
        $('#1'+id).removeClass('rotate');
    } else {
        $('#'+id+' .cube-switch3').addClass('active3');
        $('#1'+id).addClass('rotate');
    }
}

//Publish message when click button
function checkLight(element){
  var id = jQuery(element).attr('id');
  if ($('#'+id+' .cube-switch').hasClass('active')) { publish(topicControlDevice+id,"1");}
  else publish(topicControlDevice+id, "0");
}

function checkFan(element){
  var id = jQuery(element).attr('id');
  if($('#'+id+' .cube-switch3').hasClass('active3')) { publish(topicControlDevice+id,"1");}
  else publish(topicControlDevice+id, "0");
}


//Subscribe topic and change device's state when message arrive
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
        $('#1'+id).removeClass('rotate');
    }
  }
  else if(state == "on") {
      if (!$('#'+id+' .cube-switch').hasClass('active')) {
          $('#'+id+' .cube-switch3').addClass('active3');
          $('#1'+id).addClass('rotate');
     }
  }
}

function checkPirArrived(state) {
  if(state == "presence") {
    $('#humanpresence').attr('src','views/pictures/Human.PNG');
  }
  else {
    console.log("như lz");
    $('#humanpresence').attr('src','views/pictures/notHuman.PNG');
  }
}