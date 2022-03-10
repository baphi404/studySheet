function nextCard(params) {
    
}
/*
var fs = require("fs");
fs.readFile("./word_pair.txt", function(text){
    var textByLine = text.split("\n")
});
*/

/*
fetch('word_pair.json').then(results => results.json()).then(data =>{ console.log(data.sentence)
document.querySelector('#debug').innerText = data.sentence
});

var jsonData = JSON.parse(myMessage);
for (var i = 0; i < jsonData.counters.length; i++) {
    var counter = jsonData.counters[i];
    console.log(counter.counter_name);
};
*/
fetch("./word_pair.json")
.then(response => {
   return response.json();
})
.then(jsondata => console.log(jsondata));

