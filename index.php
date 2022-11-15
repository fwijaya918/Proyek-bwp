<?php
require ('helper.php');
unset($_SESSION["username"]);

if(isset($_REQUEST['btnlogin'])){

    $inUser = $_REQUEST['inUser'];
    $password = $_REQUEST['inPass'];
    $temppass="";
    $tempfullname="";
    $tempusername="";
    // $tempgender="";
    // $temphobi="";
    if($inUser=="" || $password==""){
        alert("inputan ada yang kosong");
    } else {
        $result = mysqli_query($con, "select * from users");
        while($row = mysqli_fetch_array($result)){
            if($row['username'] == $inUser ){
                $loginU=true;
                $temppass = $row['password'];
                $tempusername = $row['username'];
                $tempfullname = $row['fullname'];
                break;
            }
        }
        if($loginU){
            if($password==$temppass){
                alert("User berhasil login");
                $_SESSION['fullname']=$tempfullname;
                $_SESSION['username']= $tempusername; 
                header('Location: ./catalogue.php');
            }else{
                alert("passwordnya user salah");
            }
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="logo/Somethinc_Logo.png" width="150">
                </a>
                <div class="d-flex" role="search">
                    <div class="fw-bold mx-5 login-register"><a href="index.php" class="btnnav">Login</a></div>
                    <div class="fw-bold mx-5 login-register"><a href="register.php" class="btnnav">Register</a></div>
                </div>
            </div>
</nav>
<div class="formLogin">
    <h1>Login</h1>
    <form action="./index.php" method="post" style="">
        <div class="inputan">
            <input type="text" name="inUser" placeholder="username" style="background:transparent; border:none; color:black;"><br>
        </div>
        <div class="inputan">
            <input type="text" name="inPass" placeholder="password" style="background:transparent; border:none; color:black;"><br>
        </div>
        <button type="submit" name="btnlogin" id="btnlogin" style="margin-top:50px; background-color: pink;">Login</button>
    </form>
    <p style=" text-align:center; " >No Account? <a href="./register.php" style="">Go to Register</a></p>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</body>
</html>