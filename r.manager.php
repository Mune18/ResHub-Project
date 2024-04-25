<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Manager</title>
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
     <!-- Custom CSS file for styling -->
    <link rel="stylesheet" href="styles/res&resmanager.css">
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
                <p>Welcome to our Recipe Manager!</p>
            </div>
            <div class="main-body">
                <h1>Recipe Manager</h1>
                <div class="search_bar">
                    <input type="search" id="searchInput" placeholder="Search recipe here...">
                </div>
                <div class="row">
                    <p>All Recipe List</p>
                </div>
                     <!-- Table to display recipe information -->
                    <table class="table" id="foodListTable">
                        <thead>
                            <tr>
                                <th>Recipe ID</th>
                                <th>Recipe Name</th>
                                <th>Category</th>
                                <th>Action</th>
                                <th>Popular</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Include database configuration file
                            include("sql/config.php");
                             // SQL query to fetch all recipes
                            $sql = "SELECT * FROM tbl_recipe";
                            $result = $con->query($sql);

                            if (!$result) {
                                die("Invalid query: " . $con->error);
                            }

                            while ($row = $result->fetch_assoc()) {
                                $popularity = $row['is_popular'] ? 'Popular' : 'Not Popular';
                                 // Display recipe information in table rows
                                echo "
                                <tr data-recipe-id='{$row['tbl_id']}' data-recipe-name='{$row['tbl_recipe']}' data-category='{$row['tbl_category']}'>
                                    <td>{$row['tbl_id']}</td>
                                    <td>{$row['tbl_recipe']}</td>
                                    <td>{$row['tbl_category']}</td>
                                    <td>

                                        <!-- Edit and delete buttons with links -->
                                        <a class='btn btn-primary btn-sm' href='edit.php?id={$row['tbl_id']}'>Edit</a>
                                        <a class='btn btn-danger btn-sm' href='delete.php?id={$row['tbl_id']}'>Delete</a>
                                    </td>
                                    <td class='popularity-status'>

                                    <!-- Form for updating popularity -->
                                    <form action='updatePopularity.php' method='POST'>
                                        <input type='hidden' name='recipeId' value='{$row['tbl_id']}'>
                                        <button type='submit' name='popularity' value='1' class='btn btn-success btn-sm' style='margin-right: 5px;'>Yes</button>
                                        <button type='submit' name='popularity' value='0' class='btn btn-danger btn-sm'>No</button>
                                    </form>
                                </td>
                                <td><p>Currently: <strong>{$popularity}</strong></p></td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                
                <!-- Button to add a new recipe -->
                <a href="addRecipe.php" class="add_recipe">
                    <button type="button">Add Recipe</button>
                </a>
            </div>
        </div>
    </section>
    </div>
    <!-- JavaScript script for the search bar -->
    <script>
        // Search bar script
        document.getElementById("searchInput").addEventListener("input", performSearch);

        function performSearch() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("foodListTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var nameColumn = tr[i].getElementsByTagName("td")[1]; // Column for Recipe Name

                if (nameColumn) {
                    var nameText = nameColumn.textContent || nameColumn.innerText;

                    // Change the condition to includes for partial matches
                    if (nameText.toLowerCase().includes(filter)) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>
