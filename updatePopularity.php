<?php
// updatePopularity.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("sql/config.php");

    $recipeId = $_POST['recipeId'];
    $popularity = $_POST['popularity'];

    $updateQuery = "UPDATE tbl_recipe SET is_popular = '$popularity' WHERE tbl_id = '$recipeId'";

    if ($con->query($updateQuery) === TRUE) {
        header("Location: r.manager.php");
        exit();
    } else {
        echo "Error updating record: " . $con->error;
    }

    $con->close();
} else {
    header("Location: home.php");
    exit();
}
?>
