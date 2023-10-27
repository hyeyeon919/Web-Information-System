<!DOCTYPE html>
<html>

<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
    <h1>Sign in</h1>
    <div class="signup-form">
        <?php echo form_open(base_url() . 'newUser/signin'); ?>

        <form method="post" action="/newUser/signin">
            <php echo $error ?>
                <label for="name">name</label>
                <input type="text" id="name" name="name" required>

                <label for="username">username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">password</label>
                <input type="password" id="password" name="password" required>

                <label for="phone">phonenumber</label>
                <input type="tel" id="phonenumber" name="phonenumber" required>

                <label for="email">email</label>
                <input type="email" id="email" name="email" required>

                <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                <span id="captcha" class="g-recaptcha" data-sitekey="6LekaAcmAAAAAK1_ojghiub0yoXCPiyNbjSzBwa7"></span>

                <input value="submit" type="submit" onClick="writeChk();">
                <br />
                <script>
                    function writeChk() {
                        var v = grecaptcha.getResponse();
                        if (v.length == 0) {
                            alert("Please check the box.");
                            return;
                        }
                    }
                </script>
                <a href="<?php echo base_url() . 'login' ?>">Home</a>
        </form>
        <?php echo form_close(); ?>

    </div>
</body>

</html>