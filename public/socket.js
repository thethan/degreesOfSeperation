

//var express = require('express'),
//    http = require('http');
//var app = express();
//var Redis = require('ioredis');
//var redis = new Redis();
//var server = http.createServer(app);
//var io = require('socket.io').listen(server);
//
//
//redis.subscribe('test-channel', function(err, count) {
//});
//
//redis.psubscribe('*', function(err, count){});
//
//redis.on('message', function(channel, message) {
//    message = JSON.parse(message);
//    io.emit(channel + ':' + message.event, message.data);
//});
//
//redis.on('pmessage', function(subscribed, channel, message) {
//    message = JSON.parse(message);
//    io.emit(channel + ':' + message.event, message.data);
//});
//server.listen(3000, function(){
//    console.log('Listening on Port 3000');
//});


var app = require('http').createServer(handler);
var io = require('socket.io')(app);
var Redis = require('ioredis');
var redis = new Redis();

app.listen(3000, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

io.on('connection', function(socket) {});

redis.psubscribe('*', function(err, count) {});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});