<?php
    // Include the database configuration file
    include("sql/config.php");

    // Initialize variables for form fields
    $id = "";
    $recipe = "";
    $ingredients = "";
    $procedure = "";
    $category = "";

    // Initialize error and success messages
    $errorMessage = "";
    $successMessage = "";

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $id = $_POST["id"];
        $recipe = $_POST["recipe"];
        $ingredients = $_POST["ingredients"];
        $procedure = $_POST["procedure"];
        $category = $_POST["category"];

        // Validate form data
        do {
            if (empty($id) || empty($recipe) || empty($ingredients) || empty($procedure) || empty($category)) {
                $errorMessage = "All the fields are required";
                break;
            }

            // Add new recipe to the database
            $sql = "INSERT INTO tbl_recipe (tbl_id, tbl_recipe, tbl_ingredients, tbl_procedure, tbl_category) " .
                    "VALUES ('$id', '$recipe', '$ingredients', '$procedure', '$category')";
            $result = $con->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $con->error;
            }

            // Reset form fields
            $id = "";
            $recipe = "";
            $ingredients = "";
            $procedure = "";
            $category = "";

            // Set success message and redirect
            $successMessage = "Recipe added successfully";
            header("location: r.manager.php");
            exit;

        } while (false);
    }
?>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
      margin: 0;
      padding: 0;
      background-color: rgb(233, 233, 233);
    }
    .container {
      margin:  100px;
      padding-top: 75px;
      max-width: 3000px; 
    }
  </style>
</head>
<body>
    <div class="container my-5">
        <h2>Add Recipe</h2>

        <?php
        // Display error message if any
        if ( !empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn_close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <br>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Recipe No.</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Recipe Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="recipe" value="<?php echo $recipe; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ingredients</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" name="ingredients" value="<?php echo $ingredients; ?>"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Procedure</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" name="procedure" value="<?php echo $procedure; ?>"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" name="category" value="<?php echo $category; ?>"></textarea>
                </div>
            </div>
            <br>


            <?php
            // Display success message if any
            if ( !empty($successMessage) ) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'</button
                    </div>
                </div>
            </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="r.manager.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
</span>