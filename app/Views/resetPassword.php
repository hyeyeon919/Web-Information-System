<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
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
    <h1>Reset Password</h1>
    <div class="signup-form">
        <form method="post" action="login/resetPW">
            <label for="email">email</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">reset password</button>

            <a href="login">Back</a>

        </form>
    </div>
</body>

</html>