function onLoadGoogleCallback() {
    gapi.load('auth2', function () {
        auth2 = gapi.auth2.init({
            client_id: '720640930504-5iie69aclsvbithnfr0hakfe0tuanptn.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            scope: 'profile email'
        });
        if($('#googleSignIn').length) {
            auth2.attachClickHandler(element, {},
                    function (googleUser) {
                        console.log('Signed in: ' + googleUser.getBasicProfile().getName());
                        onSuccess(googleUser);
                    }, function (error) {
                console.log('Sign-in error', error);
            });
        }
    });

    element = document.getElementById('googleSignIn');
}
function onFailure(error) {
    console.log(error);
}
function renderButton() {
    gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 260,
        'height': 50,
        'longtitle': true,
        'theme': 'light',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    }
    );
}

function onSuccess(googleUser) {
    console.log('G sigin');
    mixpanel.track('Signup');
    $('#connect-modal').modal('hide');
    var id_token = googleUser.getAuthResponse().id_token;
    var accsTkn = gapi.auth2.getAuthInstance().currentUser.get().getAuthResponse().access_token;
    var profile = googleUser.getBasicProfile();
    openModal();
    if($('#visaForm').length) {
        var form = $('#visaForm')[0];
    } else {
        var form = $('#loginForm')[0];
    }
    var data = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open('POST', '/tokensignin');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
    xhr.onload = function () {
        var response = xhr.response;
        console.log(response.status);
        console.log(response.redirect);
        if (response.status == false) {
            console.log('Invalid Token');
        } else {
            closeModal();
            //if (response.redirect == true) {
                $('#connect-modal').modal('hide');
                //$('#connect-modal-signup').modal('show');
                location.href = '/dashboard?popup=1&uploadType=' + response.uploadType;
                console.log('redirect true');
            //} else {
                //location.href = '/dashboard?popup=1';
                //console.log('redirect false');
                //$('#connect-modal').modal('hide');
                //$('#connect-modal-mobile').modal('show');
                //$('#phone1').focus();
            //}
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
        console.log('User signed out.');
    });
}

function saveUserData(userData) {
    $.post('/userdata', {oauth_provider: 'google', userData: JSON.stringify(userData)});
}
function updateMobile()
{
    if ($('#phone1').val() == '') {
        $('#phone1').focus();
    } else {
        $('#connect-modal').modal('hide');
        openModal();
        var token = $('meta[name=csrf-token]').attr('content');
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: "/updatemobile",
            data: $('#visaForm').serialize() + "&mobile=" + $('#phone1').val(),
            headers: {"x-csrf-token": token},
            success: function (response) {
                closeModal();
                //$('#connect-modal-signup').modal('show');
                console.log(response);
                location.href = '/dashboard?popup=1';
            }
        });
    }
}

function urlencodeFormData(fd) {
    var s = '';
    function encode(s) {
        return encodeURIComponent(s).replace(/%20/g, '+');
    }
    for (var pair of fd.entries()) {
        if (typeof pair[1] == 'string') {
            s += (s ? '&' : '') + encode(pair[0]) + '=' + encode(pair[1]);
        }
    }
    return s;
}

function openModal() {
    $('.loading').show();
    //document.getElementById('loading').style.display = 'block';
    //document.getElementById('fade').style.display = 'block';
}

function closeModal() {
    $('.loading').hide();
    //document.getElementById('loader-modal').style.display = 'none';
    //document.getElementById('fade').style.display = 'none';
}