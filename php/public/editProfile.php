<?php
include("../helpers/httpflags.php");
include __DIR__ . "/../../autoloader.php";

use App\Controllers\UpdateInfos;

setCookieFlags();
session_start();

$csrfToken = App\Security\Csrf\CsrfToken::generate();

$userGetter  = new UpdateInfos($_SESSION["id"]);
var_dump($userGetter->getInfo());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <h2>Edit Infos</h2>
    <form action="editProfile-inc.php" method="POST">
        <input required type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
        <input required type="text" name="name" placeholder="name..." value="<?= isset($_GET["name"])   ? $_GET["name"] : '' ?>"><br><br>
        <input required type="text" name="surname" placeholder="surname..." value="<?= isset($_GET["surname"])   ? $_GET["surname"] : '' ?>"><br><br>
        <input required type="email" name="email" placeholder="mail..." value="<?= isset($_GET["surname"])   ? $_GET["surname"] : '' ?>"><br><br>
        <button type="submit">Update</button>
    </form>

    <h2>Edit Password</h2>
    <form action="editPasswd-inc.php" method="POST">

        <input required type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

        <input required type="password" name="passwd" placeholder="Password..."><br><br>
        <input required type="password" name="passwdconf" placeholder="PasswordConfirm..."><br><br>
        <input required type="password" name="newpasswd" placeholder="New Password"><br><br>
        <button type="submit">Update</button>
    </form>
</body>

</html>