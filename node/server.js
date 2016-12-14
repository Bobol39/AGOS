"use strict"

var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Soutenance = require("./Soutenance.js");
var DEBUG = true;
var soutenances = {};



io.on('connection', function(socket){
    socket.on('notation', function(data){
        //Un client se connecte/reconnecte dans la vue notation
        if (!(soutenances[data.id])){
            debug("Arrivée de "+data.login+": La soutenance "+data.id+" n'existe pas");
            soutenances[data.id] = new Soutenance();
            debug("Il attend l'autre professeur");
            tryEmit(socket, "waiting");
        } else {
            debug("Arrivée de "+data.login+": La soutenance "+data.id+" existe deja");
            if ((soutenances[data.id].getProf1().socket != null) && (soutenances[data.id].getProf2().socket != null)){
                debug("Tout le monde est present, plus personne n'attends");
                if (data.tuteur) tryEmit(soutenances[data.id].getProf2().socket,"stopWaiting");
                else tryEmit(soutenances[data.id].getProf1().socket,"stopWaiting");
            }else if ((soutenances[data.id].getProf1().socket == null) && (soutenances[data.id].getProf2().socket == null)){
                debug("Un professeur est deconnecté, attends");
                tryEmit(socket, "waiting");
            }else {
                debug("Tout le monde est present, plus personne n'attends");
                tryEmitToAll(data.id, "stopWaiting");
            }
        }
        creerProf(data, socket);
        socket.on("disconnect", function () {
            debug("Deconnection de "+data.login);
            tryEmitToAll(data.id, "waiting");
            if (data.tuteur) soutenances[data.id].getProf1().socket = null;
            else soutenances[data.id].getProf2().socket = null;
        })

        socket.on("startChrono", function () {
            debug("Client "+data.login+" demande le lancement du chrono");
            if (data.tuteur){
                debug("Il est bien tuteur: tous les clients demarrent le compteur");
                tryEmitToAll(data.id, "startChrono")
            }  else {debug("Il n'est pas tuteur, le chrono n'est pas lancé")}

        }).on("stopChrono", function () {
            debug("Client "+data.login+" demande à stopper le chrono");
            if (data.tuteur){
                debug("Il est bien tuteur: tous les clients stoppent le compteur");
                tryEmitToAll(data.id, "stopChrono")
            }  else {debug("Il n'est pas tuteur, le chrono n'est pas stoppé")}

        })

        socket.on("clientReadyForFusion", function () {
            debug("Client "+data.login+" signale qu'il est pret pour la fusion");
            if (data.tuteur) soutenances[data.id].getProf1().readyForFusion = true;
            else {soutenances[data.id].getProf2().readyForFusion = true;}
            if (soutenances[data.id].bothReadyForFusion()){
                debug("Tout le monde est prêt pour la fusion et arrête d'attendre");
                tryEmitToAll(data.id,"redirectFusion");
            } else {
                debug("L'autre professeur n'est pas pret, "+data.login+" doit attendre");
            }
        })
    });
});

function creerProf(data, socket) {
    if (data.tuteur){
        if (soutenances[data.id].getProf1().login != null){debug("c'est une reconnection");}
        soutenances[data.id].setProf1(data.login, socket);

    } else {
        if (soutenances[data.id].getProf2().login != null){debug("c'est une reconnection");}
        soutenances[data.id].setProf2(data.login, socket);
    }
}


function tryEmit(socket,name,data) {
    console.log(name);
    if (socket != null){
        if (data) socket.emit(name,data);
        else socket.emit(name);
    }
}

function tryEmitToAll(idsout,name,data) {
    console.log("TO ALL: "+name);
    if (soutenances[idsout].getProf1().socket != null){
        if (data) soutenances[idsout].getProf1().socket.emit(name,data);
        else soutenances[idsout].getProf1().socket.emit(name);
    }
    if (soutenances[idsout].getProf2().socket != null){
        if (data) soutenances[idsout].getProf2().socket.emit(name,data);
        else soutenances[idsout].getProf2().socket.emit(name);
    }
}

function debug(text) {
    if (DEBUG) console.log(text);
}

http.listen(3000, function(){
    console.log('listening on *:3000');
});