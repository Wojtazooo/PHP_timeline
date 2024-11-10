<?php include  __DIR__ . '/common/header.html' ?>

<body>
    <?php include __DIR__ . '/common/navigation-panel.html' ?>

    <div id="profileSpinner" class="loader" style="display: none"></div>
    <div class="page-content">
        <div id="register-panel" style="display: none">
            <h2>Register</h2>
            <form id="registerForm">
                <label for="regUsername">Username:</label>
                <input type="text" id="regUsername" name="username" required>

                <label for="regPassword">Password:</label>
                <input type="password" id="regPassword" name="password" required>
                <br>

                <button type="submit">Register</button>
            </form>

            <span>You already have account?</span>
            <button id="go-to-login-button">Login</button>
        </div>

        <div id="login-panel" style="display: none">
            <h2>Login</h2>
            <form id="loginForm">
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="username" required>

                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="password" required>
                <br>

                <button type="submit">Login</button>
            </form>

            <span>You do not have account?</span>
            <button id="go-to-register-button">Register</button>
        </div>


        <div id="profil-panel" style="display: none">
            <h2>Profile</h2>
            <div>
                <label for="profile-username">Username:</label>
                <strong id="profile-username"></strong>
            </div>

            <div>
                <label for="profile-account-created-at">Account created at:</label>
                <strong id="profile-account-created-at"></strong>
            </div>
            <br>

            <button id="log-out-button">Log out</button>

            <h2>Change password</h2>
            <form id="changePasswordForm">
                <label for="loginPassword">Password:</label>
                <input type="password" id="changePassword" name="password" required>

                <label for="loginPassword">Pass password again:</label>
                <input type="password" id="changePassword2" name="password" required>
                <br>

                <button type="submit">Change password</button>
            </form>
        </div>
    </div>
</body>


<script>
    $(document).ready(function() {
        refreshPage();
    });

    $('#log-out-button').on('click', function() {
        $('#profileSpinner').show()
        apiLogOut((response) => {
            showToastForSuccessResponse(response);
            refreshPage();
        }, () => {
            $('#profileSpinner').hide()
        });
    })

    $('#go-to-register-button').on('click', function() {
        $('#login-panel').hide();
        $('#register-panel').show();
    })

    $('#go-to-login-button').on('click', function() {
        $('#login-panel').show();
        $('#register-panel').hide();
    })

    $('#registerForm').submit(function(e) {
        e.preventDefault();

        const username = $('#regUsername').val();
        const password = $('#regPassword').val();

        const data = {
            username,
            password
        };

        $('#profileSpinner').show();
        apiRegister(data, (response) => {
            showToastForSuccessResponse(response);
            refreshPage();
        }, () => {
            $('#profileSpinner').hide();
        });
    });

    $('#loginForm').submit(function(e) {
        e.preventDefault();
        const username = $('#loginUsername').val();
        const password = $('#loginPassword').val();

        const data = {
            username,
            password
        };

        $('#profileSpinner').show();
        apiLogin(data, (response) => {
            showToastForSuccessResponse(response);
            refreshPage();
        }, () => {
            $('#profileSpinner').hide()
        });
    });

    $('#changePasswordForm').submit(function(e) {
        e.preventDefault();
        const password = $('#changePassword').val();
        const password2 = $('#changePassword2').val();

        if (password !== password2) {
            showErrorToast('Passwords must match!')
            return;
        }

        $('#profileSpinner').show();
        apiChangePassword(password, (response) => {
            showToastForSuccessResponse(response);
            refreshPage();
        }, () => {
            $('#profileSpinner').hide();
        });
    });

    function refreshPage() {
        $('#profileSpinner').show();
        $('#register-panel').hide();
        $('#registerForm')[0].reset();
        $('#login-panel').hide();
        $('#loginForm')[0].reset();
        $('#profil-panel').hide();
        $('#changePasswordForm')[0].reset();

        apiCheckSesion((response) => {
            const responseObject = JSON.parse(response);
            const loggedIn = responseObject.result.loggedIn;
            const userId = responseObject.result.userId;

            if (loggedIn) {
                $('#profileSpinner').show()
                apiGetUser(userId, (getUserResponse) => {
                    const getUserResponseObject = JSON.parse(getUserResponse);

                    $('#profil-panel').show();
                    $('#profile-username').text(getUserResponseObject.result.username)
                    $('#profile-account-created-at').text(getUserResponseObject.result.created_at)
                }, () => {
                    $('#profileSpinner').hide()
                })

            } else {
                $('#login-panel').show();
            }
            checkSession();
        }, () => {
            $('#profileSpinner').hide();
        });
    }
</script>