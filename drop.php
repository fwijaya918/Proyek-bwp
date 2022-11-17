<?php
	require("helper.php");
    $update_title = $_REQUEST['update_title'];

    // Ambil data user dari DB
    // Update data ke DB
    $update_query = "DELETE from cart WHERE id_cart='$update_title'";
    $res = $con->query($update_query);
