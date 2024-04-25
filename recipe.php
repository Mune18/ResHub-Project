<?php
// Start the PHP session
session_start();
// Include the header file
include('includes/header.php');
?>

<!-- View Modal -->
<div class="modal fade" id="viewrecipemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Recipe</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- Container to display recipe data in the modal -->
      <div id="view_recipe_data">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recipe</title> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/recipe.css">
        <style>
          /* CSS for the modal */
          .modal-dialog {
            max-width: 40%;
            margin: 1.75rem auto; 
        }
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
        </style>
    </head>
    <body>
    <!-- Main container -->
    <div class="container">
        <nav>
          <div class="navbar">
            <div class="logo">
              <img src="images/logo.png" alt="">
            </div>
            <!-- Navigation links -->
            <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="recipe.php">Recipe</a></li>
            <li><a href="r.manager.php">Recipe Manager</a></li>
            <li><a href="sql/logout.php" class="logout">Logout</a></li>
            </ul>
          </div>
        </nav>
        <!-- Main content section -->
        <section class="main">
          <div class="main-top">
            <p>Welcome to our Recipe!</p>
          </div>
          <div class="main-body">
            <h1>Recipe</h1>
           <!-- Search bar -->
          <div class="search_bar">
            <input type="search" id="searchInput" placeholder="Search recipe here...">
          </div>
          <div class="row">
            <p>All Recipe List</p>
          </div>
          <table class="table" id="foodListTable">
            <thead>
                <tr>
                    <th>Recipe Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                     // Include database configuration file
                    include("sql/config.php");
                    $sql = "SELECT * FROM tbl_recipe";
                    $result = $con->query($sql);
                    
                    if (!$result) {
                        die("Invalid query: " . $con->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>               
                            <td class='recipe_name'>{$row['tbl_recipe']}</td>
                            <td>{$row['tbl_category']}</td>
                            <td>
                                <a href='#' class='btn btn-info btn-sm view_data'>View Recipe</a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
        </section>
      </div>
    </body>
    </html>
      <!-- JavaScript script for the search bar -->
    <script>
      // Search bar script
    document.getElementById("searchInput").addEventListener("keyup", performSearch);

    function performSearch() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        table = document.getElementById("foodListTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            var nameColumn = tr[i].getElementsByTagName("td")[0]; // Column for Recipe Name

            if (nameColumn) {
                var nameText = nameColumn.textContent || nameColumn.innerText;

                // Change the condition to startsWith
                if (nameText.toLowerCase().startsWith(filter)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</span>

<?php include('includes/footers.php'); ?>

<!-- jQuery script for handling view recipe details -->
<script>

$(document).ready(function () {

    $('.view_data').click(function (e) {
      e.preventDefault();

      // Get recipe name from the clicked row
      var recipe_name =  $(this).closest('tr').find('.recipe_name').text();
      /* console.log(recipe_name); */

      // AJAX request to fetch and display recipe details
      $.ajax({
        method: "POST",
        url: "view.php",
        data: {
            'click_view_btn': true,
            'recipe_name': recipe_name,
        },
        success: function (response) {
            console.log(response); 

            // Display recipe details in the modal
            $('#view_recipe_data').html(response);
            // Show the modal
            $('#viewrecipemodal').modal('show');
        }
      });

    });

});

</script>
