let app = require('express')();
let http = require('http').Server(app);
let io = require('socket.io')(http);


http.listen(3000 , function (){
    console.log('listen to port 3000')
});

io.on('connection' , function (socket){
    socket.on("user_connected" , function (user_id){
        console.log(`user connected : ${user_id}`)
    })
});
