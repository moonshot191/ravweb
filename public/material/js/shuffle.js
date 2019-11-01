
function shuffle() {

    var src= document.getElementById("input-answer");
    var dest= document.getElementById("input-question");

    var data=src.value;
    var shuffledSentence = data.split(' ').shuffled().join(' ');
    dest.value=shuffledSentence;
    console.log(shuffledSentence);
    
}


Array.prototype.shuffled =function() {
    var i = this.length;
    if (i == 0) return this;
    while (--i) {
        var j = Math.floor(Math.random() * (i + 1 ));
        var a = this[i];
        var b = this[j];
        this[i] = b;
        this[j] = a;
    }
    return this;
}
