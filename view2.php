<!--View code for home.php-->
<?php
session_start();
include("sql/config.php");

if (isset($_POST['click_view_btn2'])) {
    $recipe_n = $_POST['recipe_name'];

    $sql = "SELECT tbl_recipe, tbl_category, tbl_ingredients, tbl_procedure FROM tbl_recipe WHERE tbl_recipe='$recipe_n'";
    $result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    die("Invalid query: " . $con->error);
    }
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    echo '
        <div class="recipe-info">
            <h6>Recipe Name:</h6>
            <p>' . $row['tbl_recipe'] . '</p>

            <h6>Category:</h6>
            <p>' . $row['tbl_category'] . '</p>

            <h6>Ingredients:</h6>
            <ul>';
    
    // Split ingredients by comma and create list items
    $ingredients = explode(',', $row['tbl_ingredients']);
    foreach ($ingredients as $ingredient) {
        echo '<li>' . trim($ingredient) . '</li>';
    }

    echo '</ul>

            <h6>Procedure:</h6>
            <p>' . $row['tbl_procedure'] . '</p>
        </div>';
}
} else {
echo '<h4>No record found</h4>';
}
?>
