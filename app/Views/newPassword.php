<!DOCTYPE html>
<html>

<head>
    <title>Sign in</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
    }

    .signup-form {
        max-width: 400px;
        margin: 0 auto;
    }

    .signup-form label {
        display: block;
        margin-bottom: 5px;
    }

    .signup-form input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
    }

    .signup-form button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        width: 100%;
    }
    </style>
</head>

<body>
    <h1>New Password for <php ?>
    </h1>
    <div class="signup-form">
        <form method="post" action="login/updatePW">
        <input type="hidden" id="hidden_email" name="hidden_email" value="<?php echo $email; ?>">
        <input type="hidden" id="hidden_token" name="hidden_token" value="<?php echo $token; ?>">
            <label for="password">new password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">submit</button>

            <a href="<?php echo base_url() . 'login' ?>">Home</a>

        </form>
    </div>
</body>

</html>