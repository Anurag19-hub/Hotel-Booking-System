
<?php
    require('inc/essential.php');
    require('inc/db_config.php');

    session_start();    
    if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true ))
    {        
        redirect('dashboard.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Login Panel </title>

    <?php
        require('inc/links.php');
    ?>

    <style>
        div.login-form{

            /* Below 4(Except Width) Lines is use for making content on the center in the screen */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>
<body class="bg-light">
    
    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">    <!--  action="someone.php"  This we can write when we wanted to submit data in other file
    but if we want to submit data within this or same page we don't need to write this line we can keep it blank-->
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL </h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
                </div>
                    
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <button name="login" type="Submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>
    

    <?php

        // // This login index is coming from the above submit btn name
        if(isset($_POST['login']))
        {                        
            //print_r($_POST);
            $frm_data = filteration($_POST);    
            //echo "<h1> $frm_data[admin_name] </h1>";
            //echo "<h1> $frm_data[admin_pass] </h1>";
           // print_r($frm_data);


            $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?  ";
            $values = [$frm_data['admin_name'], $frm_data['admin_pass']];        
            //$datatypes = "ss(string/string)";            
            // select($query,$values,$datatypes);

            $res = select($query,$values,"ss");
            //print_r($res);
 
            if($res->num_rows == 1)
            {
                $row = mysqli_fetch_assoc($res);
              // session_start();
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['sr_no'];
                redirect('dashboard.php');
            }
            else
            {
                //alert() is called from inc/essential.php  
                alert('error','Login failed - Invalid Credentials!');
            }
            
        }



        // if(isset($_POST['login']))
        // {
        //     print_r($_POST);
        // }

    ?>




    <?php
        require('inc/scripts.php');
    ?>
</body>
</html>