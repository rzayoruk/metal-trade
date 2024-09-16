<?php

include __DIR__ . "/../helpers/httpflags.php";
include __DIR__ . "/includes/functions-inc.php";

setCookieFlags();
session_start();

$csrfToken = generateCsrfToken();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("myForm").submit();
        }
    </script>

</head>

<body>
    <h1>login</h1>
    <?php if (isset($_GET["error"])) {
        if ($_GET["error"] == "captcha") {
            echo "You are robot.";
        } else if ($_GET["error"] == "csrf") {
            echo "CSRF token is necessary.";
        } else if ($_GET["error"] == "emptyfields") {
            echo "All form fields are required.";
        } else if ($_GET["error"] == "invalidemail") {
            echo "invalid email format";
        } else if ($_GET["error"] == "invalidpasswd") {
            echo "Password must consist of 8 character and also include at least 1 lower, 1 upper, 1 digit and 1 special character.";
        } else if ($_GET["error"] == "login") {
            echo "Username or password is incorrect.";
        }
    } ?>
    <form action="includes/login-inc.php" method="post" id="myForm">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
        <input type="email" name="email" placeholder="mail..." value="<?= isset($_GET["email"])   ? $_GET["email"] : '' ?>"><br><br>
        <input type="password" name="passwd" placeholder="Password..."><br><br>
        <button class="g-recaptcha" type="submit"
            data-sitekey="6Lck-kQqAAAAAJbKa7fMJ64GmKpIyeVxlppZgjw7"
            data-callback='onSubmit'
            data-action='submit'>Submit</button>
    </form>



</body>

</html>