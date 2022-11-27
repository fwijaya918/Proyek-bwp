<?php
require("helper.php");
if (!isset($_SESSION['username'])) {
    // header('Location: ./index.php');
} else {
    $fullnameActive = $_SESSION['fullname'];
    $usernameActive = $_SESSION['username'];
}

$ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
$fetchUser = mysqli_fetch_assoc($ambilUser);
$iduser = $fetchUser['id'];
$resultUang = mysqli_query($con, "SELECT SUM(product.price*cart.qty) as 'Total'
    FROM `cart` 
    LEFT JOIN `product` ON `cart`.`id_barang` = `product`.`id`
    WHERE cart.id_user='$iduser';");
$resultQty = mysqli_query($con, "SELECT SUM(cart.qty) AS QTY
    FROM `cart` 
    WHERE cart.id_user='$iduser';");
$rowQty = mysqli_fetch_assoc($resultQty);
$rowUang = mysqli_fetch_assoc($resultUang);
$TOTAL = $rowUang["Total"];
$subtotal = $rowUang["Total"];
// var_dump($snapToken);
$ALLQTY = $rowQty["QTY"];
?>
<div>
    <h3>Rincian Keranjang</h3>
    <h5>Subtotal</h5>
    <div id="containerSubTotal">
        <?= rupiah($TOTAL) ?> (<?= $ALLQTY ?> item<?php if ($ALLQTY > 1) {
                                                        echo "s";
                                                    } ?>)
    </div>
    <h5>Ongkir</h5>
    <div>Rp 19.000,00</div> <br>
    <button type="submit" onclick="cekout()" name="btnCekOut">Check Out</button>
</div>