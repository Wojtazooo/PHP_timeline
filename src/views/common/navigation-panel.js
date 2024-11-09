$(document).ready(function () {
    checkSession();
});

function checkSession() {
    apiCheckSesion((response) => {
        const responseObject = JSON.parse(response);
        const loggedIn = responseObject.result.loggedIn;

        if (loggedIn) {
            $('#profile-button').text('Profile');
            return true;
        } else {
            $('#profile-button').text('Register or Login');
            return false;
        }
    }, () => { });
}