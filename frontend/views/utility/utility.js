client = null;
connected = false;


// called when the client connects
function onConnect(context) {
  // Once a connection has been made, make a subscription and send a message.
  console.log("Client Connected");
  subscribe("IR/Learning", 0);
  subscribe("IR/Buttonlist", 0);
  subscribe("IR/Notify", 0);
  subscribe("IR/Power", 0);
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

  if((topic == "IR/Notify")){
   if(payload =="0") {
      close_waiting_popup();
    }
    if(payload =="1") {
      close_waiting_popup();
      choose_button_popup();
    }
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


    var options = {
      invocationContext: {host : hostname, port: port, path: client.path, clientId: clientId},
      timeout: timeout,
      keepAliveInterval:keepAlive,
      cleanSession: cleanSession,
      useSSL: tls,
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
    connected = false;
}


function publish(topic, message){
    console.info('Publishing Message: Topic: ', topic, '. QoS: ' + qos + '. Message: ', message);
    newMessage = new Paho.MQTT.Message(message);
    newMessage.destinationName = topic;
    newMessage.qos = Number(qos);
    newMessage.retained = retain;
    client.send(newMessage);
}


function subscribe(topic, qos){
    console.info('Subscribing to: Topic: ', topic, '. QoS: ', qos);
    client.subscribe(topic, {qos: Number(qos)});
}



  //Customize
 
function power_onclick(power_mode){
  switch(power_mode){
    case 1:
      publish("IR/Power", "1");
      enable_button("power-on");
      disable_button("power-off");
      break;
    case 2:
      publish("IR/Power", "2");
      enable_button("power-off");
      disable_button("power-on");
      break;
  }
}

function power_learning(power_mode){
    switch(power_mode){
      case 1:
        publish("IR/Buttonlist", "1");
        break;
      case 2:
        publish("IR/Buttonlist", "2");
        break;
  }
  close_choose_button_popup();
}

function learning_onclick(){
  enable_button("learning");
  publish("IR/Learning", "1");
}

function waiting_popup(){
var popup = document.getElementById('waitingPopup');
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
  if(elem.classList.contains("btn-default")) {
  elem.classList.remove("btn-default");
  elem.classList.add("btn-info");
  }
}

function disable_button(id) {
  var elem = document.getElementById(id);
  if(elem.classList.contains("btn-info")) {
  elem.classList.remove("btn-info");
  elem.classList.add("btn-default");
  } 
}

connect();