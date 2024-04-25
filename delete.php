<?php
// Delete function
if (isset($_GET["id"]) ) {
    $id = $_GET["id"];

    include("sql/config.php");

    $sql = "DELETE FROM tbl_recipe WHERE tbl_id = $id";
    $con->query($sql);
}

header("Location: r.manager.php");
exit;
?>