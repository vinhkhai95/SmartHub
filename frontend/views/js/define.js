// var hostname = "tapit.vn";
// var port = 9001;
var clientId = makeid();
// var path = "/ws";
// var ssl = false;
// var user = "vinhkhai";
// var pass = "vinhkhai";
// var keepAlive = 60;
// var timeout = 3;
// var cleanSession = false;
// var qos = 1;
// var retain = true;


//switches
var switchControl = "/switch/";
var latchControl = "/latch/";

//list sensors
var Pir	   = "/sensor/pir";
var PirDub = "/sensor/pir/dub";
var Temp   = "/sensor/temp";
var Light   = "/sensor/light";
var IR   = "/sensor/ir";

//IR devices
var ACControl = "/AC/button";
var PRControl = "/PR/button";

//button list
var AClist = {ON: 1, OFF: 2, 18: 3,20: 4, 22: 5, 24: 6, 26: 7, 28: 8};
var PRlist = {POWER: 1, UP: 2, DOWN: 3, MENU: 4, EXIT: 5};

//IR learning
var IRLearning 		= "/IR/learning";
var IRLearningACK 	= "/IR/learning/ACK";
var IRButtonList 	= "/IR/buttonlist";
var IRButtonListACK = "/IR/buttonlist/ACK";
function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}