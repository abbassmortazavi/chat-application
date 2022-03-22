let app = require('express')();
let http = require('http').Server(app);
let io = require('socket.io')(http);
let Redis = require('ioredis');
let redis = new Redis();
let users = [];


http.listen(3000 , function (){
    console.log('listen to port 3000')
});

redis.subscribe('private-channel' , function () {
    console.log('subscribed channel');
});

redis.on('message' , function (channel , message){
    console.log(channel);
    console.log(message);
});

io.on('connection' , function (socket){
    socket.on("user_connected" , function (user_id){
        users[user_id] = socket.id;
        io.emit('updateUserStatus' , users);
        console.log(`user connected : ${user_id}`)
    });

    socket.on('disconnect' , function () {
        let i = users.indexOf(socket.id);
        users.splice(i,1,0);
        io.emit('updateUserStatus' , users);
        console.log(users);
    })

});
