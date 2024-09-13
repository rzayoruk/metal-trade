<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
</head>

<body>
    <h1>SignUp</h1>
    <?php if (isset($_SESSION["errors"])) {
        echo $_SESSION["errors"];
    } ?>
    <form action="includes/signup-inc.php" method="post">
        <input type="text" name="name" placeholder="name..." value="<?= isset($_SESSION["name"])   ? $_SESSION["name"] : '' ?>"><br><br>
        <input type="text" name="surname" placeholder="surname..." value="<?= isset($_SESSION["name"])   ? $_SESSION["surname"] : '' ?>"><br><br>
        <input type="email" name="email" placeholder="mail..." value="<?= isset($_SESSION["name"])   ? $_SESSION["email"] : '' ?>"><br><br>
        <input type="password" name="passwd" placeholder="Password..."><br><br>
        <input type="password" name="passwdconf" placeholder="PasswordConfirm..."><br><br>
        <button type="submit">Sign up</button>
    </form>
    <?php session_unset()?>

</body>

</html>