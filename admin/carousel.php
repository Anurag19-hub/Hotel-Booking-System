
<?php

    require('inc/essential.php');
    adminLogin();

    session_regenerate_id(true);  // it is use to remove past session but will save past data and
                                  // create new session id 
        // IF WE WANT TO SEE REGENERATED ID THEN GOTO inspectadminpage ->Application -> cookies ->http://localhost

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Carousel </title>

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
                <h3 class="mb-4 h-font"> Images </h3>

                <!-- Carousel SECTION -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0"> Images </h5>
                            <!-- <button> Edit </button> -->
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" 
                              data-bs-target="#carousel-s">
                              <i class="bi bi-plus-square"></i> Add                                
                            </button>
                        </div>

                        <div class="row" id="carousel-data">
                            
                        </div>

                    </div>                    
                </div>

                <!-- Carousel MODAL -->
                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" 
                    data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id='carousel_s_form'>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"> Add Image </h5>
                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body">
                                                            
                                    <div class="mb-3">
                                        <label class="form-label fw-bold"> Picture </label>
                                        <input type="file" name="carousel_picture" id = 'carousel_picture_inp' 
                                           accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                           <!-- accept is kind of validation which used in html input tags for 
                                           making sure that given extention will be accepted in html5 -->
                                    </div>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="carousel_picture.value='' "
                                        class="btn text-secondary shadow-none" data-bs-dismiss="modal">                                            
                                        CANCEL
                                    </button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none"> 
                                        SUBMIT 
                                    </button>                                  
                                </div>
                            </div>
                        </form>                        
                    </div>
                </div>

                <!-- <?php echo $_SERVER['DOCUMENT_ROOT'] ?>   -->

            </div>
        </div>
    </div>

    <?php 

        require('inc/scripts.php');
    ?>

    <script src="scripts/carousel.js"></script>
</body>
</html>





