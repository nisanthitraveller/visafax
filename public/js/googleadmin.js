// Render Google Sign-in button

function renderButton() {
    console.log('Render button');
    gapi.signin2.render('my-signin2', {
        'scope': 'profile email https://www.googleapis.com/auth/drive https://www.googleapis.com/auth/drive.appfolder',
        'width': 260,
        'height': 50,
        'longtitle': true,
        'theme': 'light',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}

// Sign-in failure callback
function onFailure(error) {
    console.log(error);
}

function onSignIn(googleUser) {
    console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
}


function onSuccess(googleUser) {
    console.log('G sigin');
    var id_token = googleUser.getAuthResponse().id_token;
    var accsTkn = gapi.auth2.getAuthInstance().currentUser.get().getAuthResponse().access_token;  
    var profile = googleUser.getBasicProfile();
    openModal();
    
    var form = $('#visaForm')[0];
    var data = new FormData(form);
    
    var xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open('POST', '/bo/submitdoc' );
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
    xhr.onload = function () {
        var response = xhr.response;
        console.log(response.status);
        console.log(response.redirect);
        if(response.status == false) {
            console.log('Invalid Token');
        } else {
            closeModal();
            location.href = '/bo/bookings';
            console.log('redirect true');
        }
    };
    var formParams = urlencodeFormData(data);
    xhr.send('idtoken=' + id_token + '&accsTkn=' + accsTkn + '&' + formParams);
    //console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    //console.log('Sign in: '); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    //console.log('Image URL: ' + profile.getImageUrl());
    //console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

// Sign out the user
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        document.getElementsByClassName("userContent")[0].innerHTML = '';
        document.getElementsByClassName("userContent")[0].style.display = "none";
    });
    
    auth2.disconnect();
}

function urlencodeFormData(fd){
    var s = '';
    function encode(s){ return encodeURIComponent(s).replace(/%20/g,'+'); }
    for(var pair of fd.entries()){
        if(typeof pair[1]=='string'){
            s += (s?'&':'') + encode(pair[0])+'='+encode(pair[1]);
        }
    }
    return s;
}

function openModal() {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('fade').style.display = 'block';
}

function closeModal() {
    document.getElementById('loader-modal').style.display = 'none';
    document.getElementById('fade').style.display = 'none';
}