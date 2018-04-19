var hostname = "192.168.0.109";
var port = 8000;
var clientId = makeid();
var path = "/mqtt";
var qos = 1;
var retain = false;
var tls = false;
var user = "vinhkhai";
var pass = "vinhkhai";
var keepAlive = 60;
var timeout = 3;
var cleanSession = false;

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}