<?php
include("../helpers/httpflags.php");
include __DIR__ . "/../../autoloader.php";

use App\Controllers\UpdateInfos;

setCookieFlags();
session_start();

$csrfToken = App\Security\Csrf\CsrfToken::generate();

// $userGetter  = new UpdateInfos($_SESSION["id"]);
// $userInfos = $userGetter->getInfo();

// if (!$userInfos) {
//     return "user infos are null";
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body style="background:black; color:white;">

    <h2>Edit Infos</h2>
    <?php
    if (isset($_GET["error"])) {

        switch ($_GET["error"]) {
            case "emptyInput":
                echo "Any input couldn't be sent as empty.";
                break;
            case "invalidNames":
                echo "Name and surname should be consist of [a-zA-Z] and 1-30 character length.";
                break;
            case "invalidEmail":
                echo "Invalid email format.";
                break;
            case "db":
                echo "An error occured in db.";
                break;
            case "false":
                echo "updated successfully.";
                break;
            default:
                echo "Something went wrong.";
                break;
        }
    }
    echo var_dump($_SESSION);
    ?>
    <form action="includes/editProfile-inc.php" method="POST">
        <input required type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
        <input required type="text" name="name" placeholder="name..." value="<?= isset($_SESSION["name"])   ? $_SESSION["name"] : '' ?>"><br><br>
        <input required type="text" name="surname" placeholder="surname..." value="<?= isset($_SESSION["surname"])   ? $_SESSION["surname"] : '' ?>"><br><br>
        <input required type="email" name="email" placeholder="mail..." value="<?= isset($_SESSION["email"])   ? $_SESSION["email"] : '' ?>"><br><br>
        <button type="submit">Update</button>
    </form>

    <h2>Edit Password</h2>
    <form action="editPasswd-inc.php" method="POST">

        <input required type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

        <input required type="password" name="oldpasswd" placeholder="Old Password"><br><br>
        <input required type="password" name="newpasswd" placeholder="New Password"><br><br>
        <input required type="password" name="newpasswdconf" placeholder="New Password Confirm"><br><br>
        <button type="submit">Update</button>
    </form>
</body>

</html>