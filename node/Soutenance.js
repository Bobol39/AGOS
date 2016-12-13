/**
 * Created by pelomedusa on 13/12/2016.
 */

var method = Soutenance.prototype;

function Soutenance() {
    this.prof1 = {
        login: null,
        socket: null,
        readyForFusion : false,
        notes : {}
    };
    this.prof2 = {
        login: null,
        socket: null,
        readyForFusion : 0,
        notes : {}
    };
    this.notationTerminee = false;

}

method.bothReadyForFusion = function(){
    if (this.prof1.readyForFusion && this.prof2.readyForFusion) return true;
    return false;
}

method.setProf1 = function(prof1, socket){
    this.prof1 = {login: prof1, socket: socket};
}

method.setProf2 = function(prof2, socket){
    this.prof2 = {login: prof2, socket: socket};
}

method.getId = function() {
    return this.id;
};
method.getProf1= function() {
    return this.prof1;
};
method.getProf2 = function() {
    return this.prof2;
};


module.exports = Soutenance;