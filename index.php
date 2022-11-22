<?php
require('helper.php');
unset($_SESSION["username"]);
unset($_SESSION["fullname"]);

if (isset($_REQUEST['btnUser'])) {
    header("location:catalogue.php");
} else if (isset($_REQUEST['btnAdmin'])) {
    header("location:admin.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Portal Login</h1>
    <form action="" method="post">
        <button type="submit" name="btnUser">Login as User</button>
        <button type="submit" name="btnAdmin">Login as Admin</button>
    </form>
</body>

</html>