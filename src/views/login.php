<?php include  __DIR__ . '/common/header.html' ?>

<body>
    <?php include __DIR__ . '/common/navigation-panel.html' ?>

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
        </div>
    </div>
</body>


<script>
    $(document).ready(function() {
        refreshPage();
    });

    $('#log-out-button').on('click', function() {
        apiLogOut((response) => {
            showToastForSuccessResponse(response);
            refreshPage();
        }, () => {});
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

        apiRegister(data, (response) => {
            showToastForSuccessResponse(response);
            refreshPage();
        }, () => {});
    });

    $('#loginForm').submit(function(e) {
        e.preventDefault();
        const username = $('#loginUsername').val();
        const password = $('#loginPassword').val();

        const data = {
            username,
            password
        };

        apiLogin(data, (response) => {
            showToastForSuccessResponse(response);
            refreshPage();
        }, () => {});
    });

    function refreshPage() {
        $('#register-panel').hide();
        $('#registerForm')[0].reset();
        $('#login-panel').hide();
        $('#loginForm')[0].reset();
        $('#profil-panel').hide();

        apiCheckSesion((response) => {
            const responseObject = JSON.parse(response);
            const loggedIn = responseObject.result.loggedIn;
            const userId = responseObject.result.userId;

            if (loggedIn) {
                $('#profil-panel').show();

                apiGetUser(userId, (getUserResponse) => {
                    const getUserResponseObject = JSON.parse(getUserResponse);

                    $('#profile-username').text(getUserResponseObject.result.username)
                    $('#profile-account-created-at').text(getUserResponseObject.result.created_at)
                })

            } else {
                $('#login-panel').show();
            }
            checkSession();
        }, () => {});
    }
</script>