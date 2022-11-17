<?php
require("helper.php");
$update_title = $_REQUEST['update_title'];

// Ambil data user dari DB
$select_query = "SELECT * FROM cart WHERE id_cart='$update_title'";
$post = $con->query($select_query)->fetch_assoc();
if ($post["qty"] > 1) {
    $new_qty = $post["qty"] - 1;
} else {
    $new_qty = 1;
}
// Update data ke DB
$update_query = "UPDATE cart SET qty='$new_qty' WHERE id_cart='$update_title'";
$res = $con->query($update_query);
