function nextCard() {
 var data;
    /*
fetch('./word_pair.json').then(function (response) {
    return response.json();
  }).then(function (data)  {
    // Work with JSON data here
    console.log(data)
    document.querySelector('#debug').innerHTML = data[2].question
  })
  .catch(function (err) {
      console.log(err);
  })
*/
const jsonURL = './word_pair.json';

/// prüfen was es mit asynchronen Funktionen auf sich hat
async function getdata() {
    var resp  = await fetch(jsonURL);
    data = await resp.json();
    console.log(data);
    alert("in function = " + data[1].question);
}
getdata();
alert("out of function = " + data[1].question);
}
nextCard();
