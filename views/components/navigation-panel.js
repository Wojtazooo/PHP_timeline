$(document).ready(function () {
    apiCheckSesion((response) => {
        showToastForSuccessResponse(response);

        const responseObject = JSON.parse(response);
        const loggedIn = responseObject.result.loggedIn;

        if (loggedIn) {
            $('#profile-button').text('Profile');
        } else {
            $('#profile-button').text('Register or Login');
        }

    });
});