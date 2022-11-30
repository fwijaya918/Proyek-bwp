<?php
require('helper.php');

$listKategori = mysqli_query($con, "select * from category ");
if (!isset($imgContent)) {
    $imgContent = "";
}
if (isset($_POST["btnSubmit"])) {

    $title = $_REQUEST['inTitle'];
    $desc = $_REQUEST['inDesc'];
    $price = $_REQUEST['inPrice'];
    $category = $_REQUEST['codeKategori'];
    $qty = $_REQUEST['qty'];

    // $username = $usernameActive;
    // $fullname = $fullnameActive;
    if ($title == "" || $desc == "" || $price) {
        alert("ada yang kosong");
    } else {
        if (!empty($_FILES["image"]["name"])) {

            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            if ($file_size > 2097152) {
                $errors[] = 'File size melebihi batas';
            }

            if (empty($errors) == true && $file_name != "") {
                move_uploaded_file($file_tmp, "product/" . $file_name);
            } else {
                alert("Ukuran file melebihi batas");
            }

            $result = mysqli_query($con, "insert INTO product (id , title, price, description, thumbnail, product_category_id, stok) VALUES ('','" . $title . "' , '" . $price . "' , '" . $desc . "' ,'" . $_FILES['image']['name'] . "' ,'" . $category . "', '" . $qty . "')");
            if ($result) {
                alert("berhasil upload");
            } else {
                alert("gagal upload");
            }
        } else {
            alert("tambahkan dulu thumbnail nya");
            // $insert = $con->query("INSERT into post (p_title,p_desc ,p_img  ,p_like ,p_us_username, p_us_fullname) VALUES ('$title','$desc' ,'$imgContent',0,'$username','$fullname' )"); 
            //     if($insert){ 
            //         alert("berhasil upload");
            //     }else{ 
            //         alert("tidak terupload");
            //     }
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styleMB.css">
</head>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container" style="">
            <a class="navbar-brand" href="">
            <img src="logo/cantique.png" width="100vw" height="auto">
            </a>
            <div class="d-flex" role="search">
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterUser.php" class="btn text-decoration-none">Master User</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterBarang.php" class="btn text-decoration-none">Master Barang</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="editBarang.php" class="btn text-decoration-none">Edit Barang</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterTransaksi.php" class="btn text-decoration-none">Master Transaksi</a></div>
                <div class="mx-3 mt-2"><a href="index.php"><img src="logo/profileicon.png" height="25px" alt=""></a></div>
            </div>
        </div>
    </nav>
    <div class="formAddPost">
        <form action="./masterBarang.php" method="post" enctype="multipart/form-data">
            <h1>Add Product</h1>
            <div class="inputan">
                <input type="text" name="inTitle" placeholder="Insert product title here" style="background:transparent; border:none; color:black;"><br>
            </div>
            <div class="inputan">
                <input type="text" name="inPrice" placeholder="Insert product price here" style="background:transparent; border:none; color:black;"><br>
            </div>
            <div class="inputan">
                <textarea name="inDesc" id="" cols="80" rows="10" placeholder="Insert product description here" style="background:transparent; border:none; color:black;"></textarea>
            </div>
            <div class="inputan">
                <select name="codeKategori" id="codeKategori">
                    <?php
                    while ($row = mysqli_fetch_array($listKategori)) {
                        echo "<option value=" . $row['id_category'] . "> " . $row['nama_category'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <h5>Quantity :</h5>
            <div class="input-group mb-4 w-50">
                <button class="btn fw-bold btn-dark w-25 text-center" id="kurang" onclick="decrement()" type="button">-</button>
                <input type="text" onchange="updateTotal()" readonly class="bg-white form-control w-50 text-center" name="qty" value="1" id="qty"><br><br>
                <button id="tambah" class="btn fw-bold btn-dark w-25 text-center" onclick="increment()" type="button">+</button>
            </div>
            <div class="choosefilediv">
                <p id="addpict">Add Picture</p>
                <input type="file" id="myFile" name="image">
            </div>
            <button type="submit" name="btnSubmit" style="margin-left:20px; width:100px; background-color:green;">
                Add Product
            </button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
    function increment() {
        document.getElementById("qty").value = parseInt(document.getElementById("qty").value) + 1;
        document.getElementById("kurang").disabled = false;
        updateTotal();
    }

    function decrement() {
        if (parseInt(document.getElementById("qty").value) > 1) {
            document.getElementById("qty").value -= 1;
            if (parseInt(document.getElementById("qty").value) <= 1) {
                document.getElementById("kurang").disabled = true;
            }
        }
        updateTotal();
    }

    function updateTotal() {
        let qty = parseInt(document.getElementById("qty").value);
        let satuan = document.getElementById("satuan").innerText;
        satuan = satuan.substring(0, satuan.indexOf(","));
        satuan = parseInt(satuan.replace(/\D/g, ""));
        let subtotal = qty * satuan;
        document.getElementById("subtotal").innerText = "Rp " + numberWithCommas(subtotal) + ",00";
        console.log(subtotal);

    }
</script>

</html>