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
$result = mysqli_query($con, "SELECT * FROM `cart` WHERE `id_user`= '$iduser';");

?>

<?php
setlocale(LC_MONETARY, "id_ID");
while ($row = mysqli_fetch_assoc($result)) { ?>
    <?php
    $ambilUlangProduct = mysqli_query($con, "SELECT * FROM `product` WHERE id = '" . $row["id_barang"] . "';");
    $rowProduct = mysqli_fetch_assoc($ambilUlangProduct);
    ?>
    <div class="card mb-3" class="">
        <div class="row g-0 d-flex">
            <div class="col-xl-2">
                <img draggable="false" src="product/<?= $rowProduct["thumbnail"] ?>" class="rounded-end thumb" alt="...">
            </div>
            <div class="col-xl-10">
                <div class="card-body w-100">
                    <h5 class="card-title"><?= $rowProduct["title"] ?></h5>
                    <p class="card-text fw-bold mt-3"><?php echo rupiah($rowProduct["price"]); ?></p>

                    <?php if ($row["qty"] > $rowProduct["stok"]) : ?>
                        <!-- <div class="text-danger">Insufficient Stock </div> -->
                    <?php endif; ?>
                    <div class="d-flex justify-content-between">
                        <p class="card-text <?php if ($rowProduct["stok"] < $row["qty"]) {
                                                echo "text-danger";
                                            } ?>">Stok : <?php echo $rowProduct["stok"]; ?></p>
                        <div class="card-text d-flex fw-bold float-end">
                            <button name="dropBtn" class="mx-2 btn" onclick="drop(this)" value="<?= $row['id_cart'] ?>"><img style="width: 1.5em; height:auto;" src="logo/delete_FILL0_wght400_GRAD0_opsz48.png" alt=""></button>
                            <button name="kurangBtn" <?php
                                                        if ($row["qty"] <= 1) {
                                                            echo "disabled";
                                                        }
                                                        ?> class="mx-2 btn" onclick="kurang(this)" value="<?= $row['id_cart'] ?>"><img src="logo/remove_FILL0_wght400_GRAD0_opsz48.png" alt="" class="rounded-circle border border-1 border-dark" style="width: 1em; height:auto;"></button>
                            <div class="mx-3 px-1 py-3"><?= $row["qty"] ?></div>
                            <button name="tambahBtn" class="mx-2 btn" onclick="tambah(this)" value="<?= $row['id_cart'] ?>"><img src="logo/add_FILL0_wght400_GRAD0_opsz48.png" alt="" class="rounded-circle border border-1 border-dark" style="width: 1em; height:auto;"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>