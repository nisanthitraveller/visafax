// Render Google Sign-in button
function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}

// Sign-in success callback
/*function onSuccess(googleUser) {
    // Get the Google profile data (basic)
    //var profile = googleUser.getBasicProfile();
    
    // Retrieve the Google account data
    gapi.client.load('oauth2', 'v2', function () {
        var request = gapi.client.oauth2.userinfo.get({
            'userId': 'me'
        });
        request.execute(function (resp) {
            // Display the user details
            var profileHTML = '<h3>Welcome '+resp.given_name+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></h3>';
            profileHTML += '<img src="'+resp.picture+'"/><p><b>Google ID: </b>'+resp.id+'</p><p><b>Name: </b>'+resp.name+'</p><p><b>Email: </b>'+resp.email+'</p><p><b>Gender: </b>'+resp.gender+'</p><p><b>Locale: </b>'+resp.locale+'</p><p><b>Google Profile:</b> <a target="_blank" href="'+resp.link+'">click to view profile</a></p>';
            document.getElementsByClassName("userContent")[0].innerHTML = profileHTML;
            
            document.getElementById("gSignIn").style.display = "none";
            document.getElementsByClassName("userContent")[0].style.display = "block";
            
            saveUserData(resp)
        });
    });
}*/

// Sign-in failure callback
function onFailure(error) {
    alert(error);
}


function onSuccess(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;
    var profile = googleUser.getBasicProfile();
    $('#email').val(profile.getEmail());
    if(profile.getId()) {
        $('.manual-login').remove();
        $('.btnwhite').remove();
        $('.please-wait').show();
    }
    var xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open('POST', '/tokensignin');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
    xhr.onload = function () {
        var response = xhr.response;
        console.log(response.status);
        console.log(response.redirect);
        if(response.status == false) {
            console.log('Invalid Token');
        } else {
            if(response.redirect == true) {
                console.log('redirect true');
            } else {
                $('.please-wait').hide();
                $('.g-login').show();
                $('#phone1').focus();
            }
        }
    };
    xhr.send('idtoken=' + id_token);
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
        document.getElementById("gSignIn").style.display = "block";
    });
    
    auth2.disconnect();
}

function saveUserData(userData){
    $.post('/userdata', { oauth_provider:'google', userData: JSON.stringify(userData) });
}
function updateMobile()
{
    if($('#phone1').val() == '') {
        $('#phone1').focus();
    } else {
        jQuery.ajax({
            type: 'GET',
            url: "/updatemobile",
            data: {mobile: $('#phone1').val()},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                location.href = '/applyvisa/payment/1234';
            }
        });
    }
}