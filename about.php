
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ABOUT US </title>

    
    <?php require('main/links.php') ?> 
    <!-- SWIPERJS library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <style>
        .box{
            border-top-color: var(--teal) !important;
        }
    </style>

</head>
<body class="bg-light">    
    <!-- This file contains header or navigation -->
    <?php require('main/header.php');  ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center"> ABOUT US </h2>        
        <div class="h-line bg-dark"></div>
        
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Quam laudantium sit quas <br> a nemo nesciunt ipsa aliquid exercitationem modi quia.
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-2 order-2">
                <h3 class="mb-3">
                    Serenity Inn
                </h3>
                <p>
                With ‘Namaste’ as the enduring symbol of its brand experience and ‘Responsible Luxury’ as the guiding premise, Serenity Inn Hotels are an archetype of the culture and ethos of each destination offering authentic, indigenous luxury experiences which are in harmony with the environment and society. 
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/about/about.jpg" class="w-100" alt="image">
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/hotel.svg" width="70px" alt="image">
                    <h4 clas="mt-3">
                        100+ ROOMS
                    </h4>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/customers.svg" height="70px" width="40px" alt="image">
                    <h4 clas="mt-3">
                        200+ CUSTOMERS
                    </h4>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/rating.svg" width="70px" alt="image">
                    <h4 clas="mt-3">
                        150+ REVIEWS
                    </h4>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/staff.svg" width="70px" alt="image">
                    <h4 clas="mt-3">
                        200+ STAFFS
                    </h4>
                </div>
            </div>            
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

    <div class="container px-4">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">

                <?php
                    //$about_q = "SELECT * FROM `team_details` ";
                    $about_r = selectAll('team_details');
                    $path =  ABOUT_IMG_PATH;
                    while($row = mysqli_fetch_assoc($about_r))
                    {
                        echo <<<data
                            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                                <img src="$path$row[picture]" class="w-100" alt="image">
                                <h5 class="mt-2"> $row[name] </h5>
                            </div>                        
                        data;
                    }
                ?>

                

                <!-- <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/about/team.jpg" class="w-100" alt="image">
                    <h5 class="mt-2"> Random Name </h5>
                </div>

                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/about/team.jpg" class="w-100" alt="image">
                    <h5 class="mt-2"> Random Name </h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/about/team.jpg" class="w-100" alt="image">
                    <h5 class="mt-2"> Random Name </h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/about/team.jpg" class="w-100" alt="image">
                    <h5 class="mt-2"> Random Name </h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/about/team.jpg" class="w-100" alt="image">
                    <h5 class="mt-2"> Random Name </h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/about/team.jpg" class="w-100" alt="image">
                    <h5 class="mt-2"> Random Name </h5>
                </div> -->

            </div>
            <!--<div class="swiper-pagination pt-4"></div>-->
        </div>    
    </div>

    <!-- This file contains Footer-->
    <?php require('main/footer.php') ?>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 40,
            pagination: {
            
                el: ".swiper-pagination",
            },
            breakpoints: {
                320:{

                    slidesPerView: 1,
                },
                640:{
            
                    slidesPerView: 1,            
                },
                768:{

                    slidesPerView: 3,
                },
                1024:{

                    slidesPerView: 3,
                },
            },
            autoplay:{
                delay: 3500,
                disableOnInteraction : false,
            }
        });
    </script>

</body>
</html>