<?php
session_start();
include("sql/config.php");

// Function to get the count of recipes based on popularity
function getCount($isPopular = false) {
    global $con;

    // Use a conditional WHERE clause based on $isPopular
    $sql = "SELECT * FROM tbl_recipe" . ($isPopular ? " WHERE is_popular = 1" : "");
    $result = $con->query($sql);

    if ($result) {
        $totalCount = mysqli_num_rows($result);
        return $totalCount;
    } else {
        return 'Something Went Wrong!';
    }
}
?>
