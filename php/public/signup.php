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
    <title>Signup page</title>
</head>

<body>
    <h1>SignUp</h1>
    <?php if (isset($_GET["errors"])) {

        if ($_GET["error"] == "emptyfields") {
            echo "All form fields are required.";
        } else if ($_GET["error"] == "invalidname") {
            echo "name and surname must consist of only letters (a-zA-Z).";
        } else if ($_GET["error"] == "invalidemail") {
            echo "invalid email format";
        } else if ($_GET["error"] == "nopasswordmatch") {
            echo "passwords aren't match.";
        } else if ($_GET["error"] == "invalidpasswd") {
            echo "Password must consist of 8 character and also include at least 1 lower, 1 upper, 1 digit and 1 special character.";
        } else {
            echo
            "This email has been recorded already.";
        }
    } ?>
    <form action="includes/signup-inc.php" method="post">
        <input type="text" name="name" placeholder="name..." value="<?= isset($_SESSION["name"])   ? $_SESSION["name"] : '' ?>"><br><br>
        <input type="text" name="surname" placeholder="surname..." value="<?= isset($_SESSION["name"])   ? $_SESSION["surname"] : '' ?>"><br><br>
        <input type="email" name="email" placeholder="mail..." value="<?= isset($_SESSION["name"])   ? $_SESSION["email"] : '' ?>"><br><br>
        <input type="password" name="passwd" placeholder="Password..."><br><br>
        <input type="password" name="passwdconf" placeholder="PasswordConfirm..."><br><br>
        <button type="submit">Sign up</button>
    </form>



</body>

</html>