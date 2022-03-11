var index = 0;

function nextCard(index) {
 //var data;
    
fetch('./word_pair.json').then(function (response) {
    return response.json();
  }).then(function (data)  {
    // Work with JSON data here
    console.log(data)
    document.querySelector('#debug').innerText = data[2].question
  
  })
  .catch(function (err) {
      console.log(err);
  })
 
}
nextCard(index);

function previousCard(index) {
    //var data;
       
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
     if (index < 0) {
         index = 0;
     }
     else {
         index--;
     }
   }
   previousCard(index);


/*
const jsonURL = './word_pair.json';

/// prüfen was es mit asynchronen Funktionen auf sich hat
async function getdata() {
    var resp  = await fetch(jsonURL);
    data = await resp.json();
    console.log(data);
    alert("in function = " + data[1].question);
}
alert("haööp")
alert("out of function = " + data[1].question);
getdata();
}
nextCard();
*/