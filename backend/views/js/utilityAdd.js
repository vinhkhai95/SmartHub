//Create a client instance
client = null;
connected = false;
var topicLatchDevice = "Room"+room_id+latchControl;  //"Room1/latch/"
//console.log(AllDeviceName);

// called when the client connects
function onConnect(context) {
  // Once a connection has been made, make a subscription and send a message.
  console.log("Client Connected");
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


function connect(){
    if(path.length > 0){
      client = new Paho.MQTT.Client(hostname, Number(port), path, clientId);
    } else {
      client = new Paho.MQTT.Client(hostname, Number(port), clientId);
    }
    console.info('Connecting to Server: Hostname: ', hostname, '. Port: ', port, '. Path: ', client.path, '. Client ID: ', clientId);

    // set callback handlers
    client.onConnectionLost = onConnectionLost;

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


function subscribe(topic, qos){
    console.info('Subscribing to: Topic: ', topic, '. QoS: ', qos);
    client.subscribe(topic, {qos: Number(qos)});
}

// Just in case someone sends html
function safe_tags_regex(str) {
   return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

//Publish message when click button
function checkLatch(element){
  var id = $(element).parent().parent().parent(".col-lg-4").attr('id');
  publish(topicLatchDevice+id, "0");  
}
