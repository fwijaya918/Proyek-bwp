<?php
require('helper.php');
unset($_SESSION["username"]);
unset($_SESSION["fullname"]);

if (isset($_REQUEST['btnlogin'])) {
    $inUser = $_REQUEST['inUser'];
    $password = $_REQUEST['inPass'];
    $temppass = "";
    $tempfullname = "";
    $tempusername = "";
    // $tempgender="";
    // $temphobi="";
    if ($inUser == "" || $password == "") {
        $error = "";
    } else {
        $loginU = false;
        $result = mysqli_query($con, "select * from users");
        while ($row = mysqli_fetch_array($result)) {
            if ($row['username'] == $inUser) {
                $loginU = true;
                $temppass = $row['password'];
                $tempusername = $row['username'];
                $tempfullname = $row['fullname'];
                break;
            }
        }
        if ($loginU) {
            if ($password == $temppass) {
                alert("User berhasil login");
                $_SESSION['fullname'] = $tempfullname;
                $_SESSION['username'] = $tempusername;
                header('Location: catalogue.php');
            } else {
                $error = "Password credential does not match";
            }
        } else {
            $error = "Username does not exist.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<style>
    #empty {
        display: none;
    }
</style>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="catalogue.php">
                <img src="logo/Somethinc_Logo.png" width="150">
            </a>
            <div class="d-flex" role="search">
                <div class="fw-bold mx-5 login-register"><a href="login.php" class="btnnav text-decoration-none text-black">Login</a></div>
                <div class="fw-bold mx-5 login-register"><a href="register.php" class="btnnav text-decoration-none text-black">Register</a></div>
            </div>
        </div>
    </nav>
    <div class="formLogin bg-white w-50 mx-auto mt-5 g-3 rounded p-4">
        <h3 class="text-center mb-4">Sign In</h3>
        <form action="" method="post" class="needs-validation was-validated" novalidate>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="inUser" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="inPass" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Password</label>
            </div>
            <div class="text-danger is-invalid mb-3" id="empty">Field cannot be empty
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                </svg>
            </div>
            <?php
            if (isset($error)) {
                echo "<div class=\"text-danger mb-3\" id=\"error\">$error</div>";
            }
            ?>
            <button type="submit" name="btnlogin" id="btnlogin" class="btn btn-primary w-100" style="">Login</button>
        </form>
        <!-- <p class="text-center mt-4" ">No Account? <a href=" ./register.php" style="">Go to Register</a></p> -->
    </div>
    <div class="text-center w-50 mx-auto bg-white rounded mt-4 py-4 px-2 mb-4 border border-secondary border-3 rounded row g-3 justify-content-between needs-validation was-validated">
        <div class="h3">
            Don't have a ConnectedIn Account?
        </div>
        <div class="col-12 justify-content-center text-center">
            <a href="register.php"><button class="btn btn-outline-primary py-3 w-100" name="register">Create Account</button></a>
        </div>
        <div class="text-muted mt-5">&copy; ConnectedIn 2022</div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    document.getElementById("empty").style.display = "block";
                    document.getElementById("error").style.display = "none";
                }
                form.classList.add('was-validated');
            }, false)
        })
    })()
</script>

</html>