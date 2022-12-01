<?php
require('helper.php');

if (isset($_REQUEST['btnRegis'])) {

    $username = $_REQUEST['inUser'];
    $fullname = $_REQUEST['inFullname'];
    $password = $_REQUEST['inPass'];
    $cpassword = $_REQUEST['conPass'];


    if ($username != "" && $password != "" && $cpassword != "" && $fullname != "") {
        if ($password == $cpassword) {
            $kembar = false;
            $result = mysqli_query($con, "select username from users");
            while ($row = mysqli_fetch_array($result)) {
                if ($row['username'] == $username) {
                    $kembar = true;
                    break;
                }
            }
            if ($kembar) {
                $error = "Username already exists!";
            } else {
                $daftar = mysqli_query($con, "insert into users values('','" . $username . "', '" . $fullname . "',MD5('" . $password . "'))");
                alert("Registrasi berhasil");
            }
        } else {
            $error = "Confirm password doesn't match!";
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
    <title>Cantique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
    <style>
        #empty {
            display: none;
        }
    </style>
</head>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container-fluid" style="">
            <a class="navbar-brand" href="welcome.php">
                <img src="logo/cantique.png" width="100vw" height="auto">
            </a>
            <div class="d-flex" role="search">
                <div class="mx-3 mt-2"><a href="catalogue.php"><img src="logo/menu_book_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt=""></a></div>
                <?php if (isset($_SESSION["username"])) : ?>
                    <div class="mx-3 mt-2"><a href="cart.php"><img src="logo/shopping_cart_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt=""></a></div>
                    <div class="mx-3 mt-2"><a href="history.php"><img src="logo/history.png" height="30px" alt=""></a></div>
                <?php endif; ?>
                <?php
                if (!isset($_SESSION["username"])) :
                ?>
                    <div class="fw-bold mx-3 mt-2 text-dark login-register">
                        <a href="login.php" class="btn p-0 py-0 ps-3 pe-2 d-flex bg-primary text-decoration-none">
                            <div>Sign In</div>
                            <img src="logo/login_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt="">
                        </a>
                    </div>
                <?php else : ?>
                    <form method="POST" action="" class="mx-3 mt-2 d-flex fw-bold h-auto align-center text-dark login-register bg-primary rounded">
                        <button type="submit" name="logout" class="btn py-0 ps-3 pe-2 d-flex justify-content-between">
                            <div class="me-2">Sign Out</div>
                            <div>
                                <img src="logo/logout_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt="">
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
                <!-- <div class="mx-3 mt-2"><a href="index.php"><img src="logo/profileicon.png" height="25px" alt=""></a></div> -->
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="border border-secondary border-3 g-3 bg-white rounded w-50 p-4 mx-auto mt-5">
            <h3 class="text-center mb-4">Sign Up</h3>
            <form action="" method="post" class="needs-validation was-validated" novalidate>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="inUser" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="inFullname" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Full name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="inPass" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="conPass" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Confirm Password</label>
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
                <button type="submit" name="btnRegis" id="" class="btn btn-primary w-100">Register</button>

            </form>
            <p style=" text-align:center;" class="mt-4">Already have an account? <a href="./login.php" style="">Sign In</a></p>
        </div>
    </div>
    <div class="container-fluid bg-white px-4 py-2 fixed-bottom">&copy; 2022 Cantique. All Rights Reserved</div>
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