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
$resultUang = mysqli_query($con, "SELECT SUM(product.price) as 'Total'
    FROM `cart` 
    LEFT JOIN `product` ON `cart`.`id_barang` = `product`.`id`
    WHERE cart.id_user='$usernameActive';");
$resultQty = mysqli_query($con, "SELECT SUM(cart.qty) AS QTY
    FROM `cart` 
    WHERE cart.id_user='$usernameActive';");


?>

<?php
while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="bungkusItem">
        <?php
        $ambilUlangProduct = mysqli_query($con, "SELECT * FROM `product`;");
        while ($rowProduct = mysqli_fetch_assoc($ambilUlangProduct)) {
            if ($row['id_barang'] == $rowProduct['id']) { ?>
                <div class="fotothumb">
                    <?php
                    $tempNamaBarang = $rowProduct['title'];
                    $tempHargaBarang = $rowProduct['price'];
                    ?>
                    <img src="product/<?= $rowProduct["thumbnail"]  ?>" class="card-img-top border border-2 border-dark rounded" alt="'<?= $rowProduct["title"]  ?>'">

                </div>
            <?php
            } ?>
        <?php
        }
        ?>
        <div class="deskripsithumb">
            <h5>Nama Product</h5>
            <p><?= $tempNamaBarang ?></p>
            <h5>Harga Product</h5>
            <p><?= $tempHargaBarang ?></p>
            <h5>Banyak yang dibeli</h5>
            <p><?= $row['qty'] ?></p>
            <button name="kurangBtn" onclick="kurang(this)" value="<?= $row['id_cart'] ?>">-</button>
            <button name="tambahBtn" onclick="tambah(this)" value="<?= $row['id_cart'] ?>">+</button>
            <button name="dropBtn" onclick="drop(this)" value="<?= $row['id_cart'] ?>">Delete </button>
        </div>

    </div>
<?php
}
?>