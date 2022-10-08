// Copyright (c) 2012 The Chromium Authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.


var url = 'http://shoppia.ro/admin_spreadsheet/';

jQ = jQuery.noConflict(true);
var oauth = ChromeExOAuth.initBackgroundPage({
  'request_url' : 'https://www.google.com/accounts/OAuthGetRequestToken',
  'authorize_url' : 'https://www.google.com/accounts/OAuthAuthorizeToken',
  'access_url' : 'https://www.google.com/accounts/OAuthGetAccessToken',
  'consumer_key' : 'anonymous',
  'consumer_secret' : 'anonymous',
  'scope' : 'https://www.googleapis.com/auth/userinfo.email',
  'app_name' : 'Spreadsheet Bookmarker'
});

var contacts = null;
 

function onContacts(text, xhr) {
var request = new XMLHttpRequest();
var tabUrl;
var tabTitle;
if (request == null){
        alert("Unable to create request");
    }else{

        var url = url+"inc/ajax.php";

        request.onreadystatechange = function()
		{
            if(request.readyState == 4)
            {
                LDResponse(request.responseText);
            }
        }
		    chrome.tabs.getSelected(null, function(tab) { 
			
				tabUrl =  tab.url ;
				tabTitle =  tab.title ;
				time = new Date().getTime();  
			jQ.ajax ({
				url:url,
				type:"post",
				data:{email:text,url:tabUrl,action:"add_row",time:time,title:tabTitle}
			 });
			}); 
    }
}
function LDResponse(response)
{
// do stuff with the response
} 
function getContacts() { 
  oauth.authorize(function() {
    console.log("on authorize");
    setIcon();
    var url = "https://www.googleapis.com/userinfo/email";
    oauth.sendSignedRequest(url, onContacts, {
       
    });
  });
};

function logout() {
  oauth.clearTokens();
  setIcon();
};

setIcon();
chrome.browserAction.onClicked.addListener(getContacts);
 
function setIcon() {
     chrome.browserAction.setIcon({ 'path' : url+'icon.php'});
 
};
 
 