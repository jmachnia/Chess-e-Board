// Called after both players are logged in
function startConnectGetFEN() {
    // Generate a random client ID
    clientID = "clientID-" + parseInt(Math.random() * 100);

    // Fetch the hostname/IP address and port number
    host = "broker.mqttdashboard.com";
    port = "8000";

    // Initialize new Paho client connection
    client = new Paho.MQTT.Client(host, Number(port), clientID);

    // Set callback handlers
    client.onConnectionLost = onConnectionLost;
    //client.onMessageArrived = onMessageArrived;

    // Connect the client, if successful, call onConnect function
    client.connect({ 
        onSuccess: onConnect,
    });
}

// Called when the client connects
function onConnect() {
    // Fetch the MQTT topic
    topic = "Chess e-Board get FEN";
    document.getElementById("getFEN").innerHTML = '<span>' + topic + '</span>';
    // Subscribe to the requested topic
    client.subscribe(topic);
}

// Called when the client loses its connection
function onConnectionLost(responseObject) {
    console.log("onConnectionLost: Connection Lost");
    if (responseObject.errorCode !== 0) {
        console.log("onConnectionLost: " + responseObject.errorMessage);
    }
}

// Called when a message arrives
function onMessageArrived(message) {
    console.log("onMessageArrived: " + message.payloadString);
    document.getElementById("getFEN").innerHTML = '<span>' + message.payloadString + '</span>';
    decode(message);
}

// Called when both players log out
function startDisconnectGetFEN() {
    client.disconnect();
}

function getFEN(message) {
    console.log("onMessageArrived: " + message.payloadString);
    document.getElementById("getFEN").innerHTML = '<span>' + message.payloadString + '</span>';
}

function decode(message)
{
    FEN = message.payloadString;
    var i = 1;
    var j = 1;
    for(let k = 0; k < FEN.length; k++)
    {
        if(FEN[k] != '/')
        {
            if(FEN[k] == 1 || FEN[k] == 2 || FEN[k] == 3 || FEN[k] == 4 || FEN[k] == 5 || FEN[k] == 6 || FEN[k] == 7 || FEN[k] == 8) {
                j = j + FEN[k];
            }
            if(FEN[k] == 'r') {
                document.getElementById("board").innerHTML = '<img class="piece br square-' + j + i + '" src="images/black_rook.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'n') {
                document.getElementById("board").innerHTML = '<img class="piece bn square-' + j + i + '" src="images/black_knight.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'b') {
                document.getElementById("board").innerHTML = '<img class="piece bb square-' + j + i + '" src="images/black_bishop.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'q') {
                document.getElementById("board").innerHTML = '<img class="piece bq square-' + j + i + '" src="images/black_queen.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'k') {
                document.getElementById("board").innerHTML = '<img class="piece bk square-' + j + i + '" src="images/black_king.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'p') {
                document.getElementById("board").innerHTML = '<img class="piece bp square-' + j + i + '" src="images/black_pawn.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'R') {
                document.getElementById("board").innerHTML = '<img class="piece wr square-' + j + i + '" src="images/white_rook.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'N') {
                document.getElementById("board").innerHTML = '<img class="piece wn square-' + j + i + '" src="images/white_knight.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'B') {
                document.getElementById("board").innerHTML = '<img class="piece wb square-' + j + i + '" src="images/white_bishop.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'Q') {
                document.getElementById("board").innerHTML = '<img class="piece wq square-' + j + i + '" src="images/white_queen.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'K') {
                document.getElementById("board").innerHTML = '<img class="piece wk square-' + j + i + '" src="images/white_king.png" />';
                j = j + 1;
            }
            if(FEN[k] == 'P') {
                document.getElementById("board").innerHTML = '<img class="piece wp square-' + j + i + '" src="images/white_pawn.png" />';
                j = j + 1;
            }
        }
        if(FEN[k] == '/') 
        {
            i = i + 1;
            j = 1;
        }
    }
}