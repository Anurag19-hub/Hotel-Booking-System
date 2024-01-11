<?php

    require('inc/essential.php');
    require('inc/db_config.php');
    adminLogin();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Users </title>

    <?php  
    
        require('inc/links.php');    
    ?>

</head>
<body class='bg-light'>

   <?php
    require("inc/header.php");
   ?>


    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 h-font"> Users </h3>

                <!-- Add Room SECTION -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            
                            <!-- <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type anything to search"> -->

                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width: 900px;">
                                <thead>
                                <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col"> Fullname </th>
                                    <th scope="col"> Username </th>
                                    <th scope="col"> Email </th>
                                    <th scope="col"> Verified </th>
                                    <th scope="col"> Date </th>
                                    <th scope="col"> Action </th>
                                </tr>
                                </thead>
                                <tbody id="users-data">

                                </tbody>
                            </table>
                        </div>

                    </div>                    
                </div> 
                
            </div>
        </div>
    </div>


    




    <?php require('inc/scripts.php'); ?>

    <script src="scripts/users.js"></script>

    
</body>
</html>





