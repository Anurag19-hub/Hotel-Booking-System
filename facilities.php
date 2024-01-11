<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> FACILITIES </title>

    
    <?php require('main/links.php') ?> 
    <!-- SWIPERJS library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <style>
        .pop:hover{

            /*We have used !important bcs we have given inline css color black and inline css is important and 
            documentary css(biji koi ) can never override it  
            INLINE css Is more important than this so override it we have used !important   
            */

            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>


</head>
<body class="bg-light">    
    <!-- This file contains header or navigation -->
    <?php require('main/header.php');  ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center"> OUR FACILITIES </h2>
        <div class="h-line bg-dark"></div>
        
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Quam laudantium sit quas <br> a nemo nesciunt ipsa aliquid exercitationem modi quia.
        </p>
    </div>

    <div class="container">
        <div class="row">

            <?php
                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($res))
                {
                    echo <<<data
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop" style="height:195px;">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="$path$row[icon]" width="40px" alt="image">
                                    <h5 class="m-0 ms-3">$row[name]</h5>                                    
                                </div>       
                                <p>
                                    $row[description]
                                </p>             
                            </div>
                        </div>
                    data;
                }

            ?>
            

            <!-- <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px" alt="image">
                        <h5 class="m-0 ms-3">wifi</h5>                        
                    </div>       
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Dolore reprehenderit ad autem nostrum neque totam accusantium!
                    </p>             
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px" alt="image">
                        <h5 class="m-0 ms-3">wifi</h5>                        
                    </div>       
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Dolore reprehenderit ad autem nostrum neque totam accusantium!
                    </p>             
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px" alt="image">
                        <h5 class="m-0 ms-3">wifi</h5>                        
                    </div>       
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Dolore reprehenderit ad autem nostrum neque totam accusantium!
                    </p>             
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px" alt="image">
                        <h5 class="m-0 ms-3">wifi</h5>                        
                    </div>       
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Dolore reprehenderit ad autem nostrum neque totam accusantium!
                    </p>             
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px" alt="image">
                        <h5 class="m-0 ms-3">wifi</h5>                        
                    </div>       
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Dolore reprehenderit ad autem nostrum neque totam accusantium!
                    </p>             
                </div>
            </div>              -->

        </div>
    </div>


    <!-- This file contains Footer-->
    <?php require('main/footer.php') ?>
    
</body>
</html>