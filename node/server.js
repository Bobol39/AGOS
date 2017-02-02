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

        socket.on("clientReadyForFusion", function (notes) {
            debug("Client "+data.login+" signale qu'il est pret pour la fusion");
            debug("Notes reçues:\n" +
                "sliders: "+notes.sliders +
                "\n buttons: "+notes.buttons);

            if (data.tuteur){
                soutenances[data.id].getProf1().readyForFusion = true;
                soutenances[data.id].getProf1().notes = notes;
            }
            else {
                soutenances[data.id].getProf2().readyForFusion = true;
                soutenances[data.id].getProf2().notes = notes;
            }
            if (soutenances[data.id].bothReadyForFusion()){
                debug("Tout le monde est prêt pour la fusion et arrête d'attendre");
                tryEmitToAll(data.id,"redirectFusion");
            } else {
                debug("L'autre professeur n'est pas pret, "+data.login+" doit attendre");
            }
        })
    });

    socket.on('fusion',function(data){
        if (data.tuteur) soutenances[data.idsout].getProf1().socket = socket;
        else soutenances[data.idsout].getProf2().socket = socket;
        debug("Un client a chargé la fusion et demande les notes");
        var notes = {p1: soutenances[data.idsout].getProf1().notes, p2: soutenances[data.idsout].getProf2().notes};
        socket.emit('getNotes',notes);

        socket.on('deliberer', function (notesFinales) {
            if (data.tuteur){
                debug("Le tuteur "+soutenances[data.idsout].getProf1().login+" veut deliberer");
                soutenances[data.idsout].getProf1().notesFinales = notesFinales;
            }
            else {
                debug("Le non-tuteur "+soutenances[data.idsout].getProf2().login+" veut deliberer");
                soutenances[data.idsout].getProf2().notesFinales = notesFinales;
            }

            if (!(soutenances[data.idsout].getProf1().notesFinales) || !(soutenances[data.idsout].getProf2().notesFinales)) {
                debug("En attente de l'autre professeur");
                socket.emit("deliberationWaiting");
            } else {
                debug("Les deux profs ont délibéré");
                if (JSON.stringify(soutenances[data.idsout].getProf1().notesFinales) == JSON.stringify(soutenances[data.idsout].getProf2().notesFinales)){
                    debug("Les notes sont les mêmes, c'est fini");
                    soutenances[data.idsout].getProf1().socket.emit("deliberationFinished",soutenances[data.idsout].getProf1().notesFinales);
                    soutenances[data.idsout].getProf2().socket.emit("deliberationFinished",soutenances[data.idsout].getProf1().notesFinales);
                } else {
                    debug("Les notes sont differentes, c'est reparti");
                    soutenances[data.idsout].getProf1().notesFinales = null;
                    soutenances[data.idsout].getProf2().notesFinales = null;
                    soutenances[data.idsout].getProf1().socket.emit("deliberationNotEqual");
                    soutenances[data.idsout].getProf2().socket.emit("deliberationNotEqual");
                }
            }
        }).on('theend', function () {
            delete soutenances[data.idsout];
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
    debug(name);
    if (socket != null){
        if (data) socket.emit(name,data);
        else socket.emit(name);
    }
}

function tryEmitToAll(idsout,name,data) {
    debug("TO ALL: "+name);
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
    debug('listening on *:3000');
});