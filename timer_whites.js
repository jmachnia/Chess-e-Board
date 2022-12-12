// Called after form input is processed
function startConnectTimerWhites() {
    // Generate a random client ID
    clientID = "clientID-" + parseInt(Math.random() * 100);

    // Fetch the hostname/IP address and port number
    host = "broker.mqttdashboard.com";
    port = "8000";

    // Print output for the user in the messages div
    // document.getElementById("messages").innerHTML = '<span>Connecting to: ' + host + ' on port: ' + port + '</span><br/>';
    // document.getElementById("messages").innerHTML += '<span>Using the following client value: ' + clientID + '</span><br/>';

    // Initialize new Paho client connection
    client = new Paho.MQTT.Client(host, Number(port), clientID);

    // Set callback handlers
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    // Connect the client, if successful, call onConnect function
    client.connect({ 
        onSuccess: onConnect,
    });
}

// Called when the client connects
function onConnect() {
    // Fetch the MQTT topic
    topic = "Chess e-Board timer whites";

    // Print output for the user in the messages div
    // document.getElementById("messages").innerHTML += '<span>Subscribing to: ' + topic + '</span><br/>';

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
    document.getElementById("timer-whites").innerHTML = '<span>' + message.payloadString + '</span><br/>';
    // updateScroll(); // Scroll to bottom of window
}

// Called when the disconnection button is pressed
function startDisconnectTimerWhites() {
    client.disconnect();
    // document.getElementById("timer-whites").innerHTML = '<span>Disconnected</span><br/>';
    // updateScroll(); // Scroll to bottom of window
}

// Updates #messages div to auto-scroll
function updateScroll() {
    var element = document.getElementById("timer-whites");
    element.scrollTop = element.scrollHeight;
}