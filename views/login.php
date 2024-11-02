<?php include  __DIR__ . '/common/header.html' ?>

<body>
    <?php include __DIR__ . '/components/navigation-panel.html' ?>

    <h2>Register</h2>
    <form id="registerForm">
        <label for="regUsername">Username:</label>
        <input type="text" id="regUsername" name="username" required><br><br>

        <label for="regPassword">Password:</label>
        <input type="password" id="regPassword" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>

    <hr>

    <!-- Login Form -->
    <h2>Login</h2>
    <form id="loginForm">
        <label for="loginUsername">Username:</label>
        <input type="text" id="loginUsername" name="username" required><br><br>

        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

</body>

<script src=views/components/navigation-panel.js></script>
<script>
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

        apiLogin(data, (response) => {
            showToastForSuccessResponse(response);
        });
    });
</script>