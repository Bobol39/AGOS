var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

class Soutenance {
    constructor(id, prof1,socket) {
        this.id = id;
        this.prof1 = {login: prof1, socket: socket};
        this.prof2 = null;
    }

    setProf2(prof2, socket){
        this.prof2 = {login: prof2, socket: socket};
    }
}

var soutenances = [];


io.on('connection', function(socket){

    var soutTrouve = null;
    socket.on('notation', function(data){
        soutenances.forEach(function(sout){
            if (sout.id == data.id){
                soutTrouve = sout;
            }
        });
        if (soutTrouve == null){
            soutTrouve = new Soutenance(data.id, data.login, socket);
            soutenances.push(soutTrouve);
            console.log("prof1 FIRST CONNECTION");
            socket.emit("waiting");
        }else if ((soutTrouve.prof2 == null) && (soutTrouve.prof1.login != data.login)){
            console.log("prof2 FIRST CONNECTION");
            soutTrouve.setProf2(data.login, socket);
            tryEmit(soutTrouve.prof1.socket, "stopWaiting")

        } else if ((soutTrouve.prof1 != null) && (soutTrouve.prof2 != null)){
            if (soutTrouve.prof1.login == data.login){
                console.log("Prof1 reconnected");
                tryEmit(soutTrouve.prof2.socket, "stopWaiting");
                soutTrouve.prof1.socket = socket;
            }
            else if (soutTrouve.prof2.login == data.login) {
                console.log("Prof2 reconnected");
                tryEmit(soutTrouve.prof1.socket, "stopWaiting");
                soutTrouve.prof2.socket = socket;

            }
            else console.log("THIS SHOULD NOT HAPPEN");
        }
    });
    socket.on("disconnect", function () {
        soutenances.forEach(function (sout) {
            console.log(sout.prof1.login+","+sout.prof2.login);
            if (sout.prof1.socket == socket){
                console.log("prof1 disconnected");
                tryEmit(sout.prof2.socket, "waiting");
            } else if (sout.prof2.socket == socket){
                console.log("prof2 disconnected");
                tryEmit(sout.prof1.socket, "waiting");
            }
        })
    })
});

function tryEmit(socket,name,data) {
    if (socket != null){
        if (data) socket.emit(name,data);
        else socket.emit(name);
    }
}

http.listen(3000, function(){
    console.log('listening on *:3000');
});