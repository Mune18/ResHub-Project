<!--View code for recipe.php-->
<?php
// Start the session and include the database configuration file
session_start();
include("sql/config.php");

// Check if the "View Recipe" button is clicked
if (isset($_POST['click_view_btn'])) {
    // Get the recipe name from the post data
    $recipe_n = $_POST['recipe_name'];

     // SQL query to retrieve recipe details based on the recipe name
    $sql = "SELECT * FROM tbl_recipe WHERE tbl_recipe='$recipe_n'";
    $result = $con->query($sql);

    // Check if the query was successful
    if (!$result) {
        // Display an error message if the query fails
        die("Invalid query: " . $con->error);
    }

    // Loop through the results and display recipe details
    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="recipe-info">
                <h6>Recipe Name:</h6>
                <p>' . nl2br($row['tbl_recipe']) . '</p>

                <h6>Category:</h6>
                <p>' . nl2br($row['tbl_category']) . '</p>

                <h6>Ingredients:</h6>
                <ul>';
        
        // Split ingredients by comma and create list items
        $ingredients = explode(',', $row['tbl_ingredients']);
        foreach ($ingredients as $ingredient) {
            echo '<li>' . nl2br(trim($ingredient)) . '</li>';
        }

        echo '</ul>

                <h6>Procedure:</h6>
                <p>' . nl2br($row['tbl_procedure']) . '</p>
            </div>';
    }
} else {
    // Display a message if no record is found
    echo '<h4>No record found</h4>';
}
?>
