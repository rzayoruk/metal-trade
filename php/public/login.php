<?php
session_start();
if (isset($_SESSION["name"])) {
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
</head>

<body>
    <h1>login</h1>
    <?php if (isset($_GET["error"])) {

        if ($_GET["error"] == "emptyfields") {
            echo "All form fields are required.";
        } else if ($_GET["error"] == "invalidemail") {
            echo "invalid email format";
        } else if ($_GET["error"] == "invalidpasswd") {
            echo "Password must consist of 8 character and also include at least 1 lower, 1 upper, 1 digit and 1 special character.";
        } else if ($_GET["error"] == "login") {
            echo "Username or password is incorrect.";
        }
    } ?>
    <form action="includes/login-inc.php" method="post">
        <input type="email" name="email" placeholder="mail..." value="<?= isset($_GET["email"])   ? $_GET["email"] : '' ?>"><br><br>
        <input type="password" name="passwd" placeholder="Password..."><br><br>
        <button type="submit">login</button>
    </form>



</body>

</html>