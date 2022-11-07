
let backendUrl = 'https://spreadsheet-bookmarker.nohandsapps.ca/';
// let backendUrl = 'http://localhost/spreadsheet-bookmarker/save-spreadsheet/';

function ProcessAllTabs() {
    // do not specify query options to get 
    // all tabs in all windows for current user
    chrome.tabs.query({active: true, lastFocusedWindow: true}, tabs => {
        let url = tabs[0].url;
        let title = tabs[0].title;
        chrome.storage.local.get(['email'], function(result) {
            console.log('Value currently is ' + result.email);
            let data = {
                url :  url,
                email:result.email,
				title :  title,
				time : new Date().getTime()
            }

            sendUserData(data)
            // getIcon();
        });
        
    });
}


function sendUserData(data){
    fetch(backendUrl+"spreadsheet.php", {
        method: "POST",
        headers: {'Content-Type': 'application/json'}, 
        body: JSON.stringify(data)
      }).then(res => {
        console.log("Request complete! response:", res);
      });
}


function getIcon(){
    fetch(backendUrl+"image.php")
    .then(res =>{
        doCanvas(res)
    })
    .catch(err => { throw err });
}


function doCanvas(data){
    const canvas = new OffscreenCanvas(16, 16);
    const context = canvas.getContext('2d');

    var image = new Image();
    image.onload = function() {
    ctx.drawImage(image, 0, 0);
    };
    image.src = data;
    // context.clearRect(0, 0, 16, 16);
    // context.fillStyle = '#00FF00';  // Green
    // context.fillRect(0, 0, 16, 16);
    const imageData = context.getImageData(0, 0, 16, 16);
    chrome.action.setIcon({imageData: imageData})
}

chrome.action.setIcon({
    path : {
      "16": "images/logo.png"
    }
})
// chrome.action.setIcon({
//     path : {
//       "16": "images/logo.png"
//     }
// });

chrome.identity.getAuthToken({
    'interactive': true
},function(token){

    fetch(`https://www.googleapis.com/oauth2/v3/userinfo?access_token=${token}`)
    .then((response) => response.json())
    .then((response) => {
        console.log(response)
        chrome.storage.local.set({email: response.email}, function() {
            console.log('Value is set to ' + response);
          });
    })
})


// register the event listeners
chrome.tabs.onActivated.addListener(ProcessAllTabs);
chrome.tabs.onUpdated.addListener(ProcessAllTabs);