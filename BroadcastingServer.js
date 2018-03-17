/**
 * Created by 5 on 2018/3/17.
 */
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis({
    port: 6379,          // Redis port
    host: '47.89.244.162',   // Redis host
});
// Redis 訂閱 `chat-channel` 頻道
redis.subscribe('receive', function (err, count) {
    console.log('redis connect!');
});
// 當 Redis 有事件發生時，透過 Socket.IO Server 發送事件
var count = 0;
redis.on('message', function (channel, message) {
    console.log("message:" + message);
    message = JSON.parse(message);
    count += 1;
    io.emit(channel+':'+message.event, message.data);
    console.log("Sending Finished " + count);
});
// 讓用戶端可以透過 Port 3000 連接 Socket.IO Server
http.listen(3000, function () {
    console.log('Listening on Port 3000');
});
