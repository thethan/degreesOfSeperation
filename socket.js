

var express = require('express'),
    http = require('http');
var app = express();
var Redis = require('ioredis');
var redis = new Redis();
var server = http.createServer(app);
var io = require('socket.io').listen(server);


redis.subscribe('test-channel', function(err, count) {
});
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
server.listen(3000, function(){
    console.log('Listening on Port 3000');
});