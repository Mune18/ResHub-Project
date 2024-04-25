<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login.php
    header("Location: login.php");
    exit(); // Make sure to exit after a header redirect
}

require('sql/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/home.css">
    <style>
        /* CSS for the modal */
        .modal-content {
            background-color: #f0f0f0;
            color: black; 
        }

        .modal-header {
            background-color: #2F8DC4; 
            color: #fff; 
        }

        .modal-footer {
            background-color: white; 
            color: #fff; 
        }
        .custom-box {
            margin-bottom: 15px;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            background-color: white;
            width: 98%;
            border: 2px solid rgb(190, 190, 190);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }
        .col-md-3:last-child {
            margin-left: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <div class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="">
            </div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="recipe.php">Recipe</a></li>
                <li><a href="r.manager.php">Recipe Manager</a></li>
                <li><a href="sql/logout.php" class="logout">Logout</a></li>
            </ul>
        </div>
    </nav>
    <section class="main">
        <div class="main-top">
            <p>Welcome!</p>
        </div>
        <div class="main-body">
            <h1>Home</h1>
            <div class="row">
                <p>Popular Recipes</p>
                <div>
                    <a href="recipe.php">See all</a>
                </div>
            </div>
            <?php
            $popularRecipesQuery = "SELECT * FROM tbl_recipe WHERE is_popular = 1";
            $popularRecipesResult = $con->query($popularRecipesQuery);

            if ($popularRecipesResult->num_rows > 0) {
                while ($row = $popularRecipesResult->fetch_assoc()) {
                    echo '<div class="row custom-box">
                            <div class="col-md-6">
                                <h2>' . $row['tbl_recipe'] . '</h2>
                                <span>' . $row['tbl_category'] . '</span>
                            </div>
                            <div class="col-md-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewRecipeModal' . $row['tbl_id'] . '">
                                    View Recipe
                                </button>
                            </div>
                        </div>';
                        
                    // Modal for each recipe
                    echo '<div class="modal fade" id="viewRecipeModal' . $row['tbl_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel' . $row['tbl_id'] . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Recipe</h1>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="recipe-info">
                                    <h6>Recipe Name:</h6>
                                    <p>' . $row['tbl_recipe'] . '</p>
                                    <br>
                                    <h6>Category:</h6>  
                                    <p>' . $row['tbl_category'] . '</p>
                                    <br>
                                    <h6>Ingredients:</h6>
                                    <p style="line-height: 1;">' . nl2br($row['tbl_ingredients']) . '</p>
                                    <br>
                                    <h6>Procedure:</h6>  
                                    <p style="line-height: 1;">' . nl2br($row['tbl_procedure']) . '</p>
                                    <!-- Add more details based on your database structure -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            } else {
                echo '<p>No popular recipes found.</p>';
            }
            ?>
        </div>
    </section>
</div>


<!-- Bootstrap JS and jQuery (Make sure to include these scripts at the end of the body) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
