<?php
// Include the file with the getCount function
include("dashB_Func.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/dashboard.css">
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
            <p>Welcome to Dashboard!</p>
        </div>
        <div class="main-body">
            <h1>Dashboard</h1>
            <div class="row mt-4"> <!-- Added mt-4 for top margin -->
                <div class="col-md-3 mb-3">
                    <div class="card card-body p-3">
                        <p class="text-sm mb-0 text-capitalize">Total Recipe</p>
                        <h5 class="fontw-bold mb-0"><?= getCount() ?></h5>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card card-body p-3">
                        <p class="text-sm mb-0 text-capitalize">Total Popular Recipe</p>
                        <h5 class="fontw-bold mb-0"><?= getCount(true) ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Bootstrap JS and jQuery (Make sure to include these scripts at the end of the body) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
