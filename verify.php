<?php

    require('admin/inc/db_config.php');
    require('admin/inc/essential.php');

    if(isset($_GET['email']) &&  isset($_GET['v_code']))
    {
        $query = "SELECT * FROM `user_cred` WHERE `email`='$_GET[email]' AND `verification_code`='$_GET[v_code]' ";
        
        $result = mysqli_query($con, $query);

        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['is_verified']==0)
                {
                    $update = "UPDATE `user_cred` SET `is_verified`='1' WHERE `email`='$result_fetch[email]' ";
                    
                    if(mysqli_query($con, $update))
                    {
                        alert('success','email verification successful');
                        echo "
                            <script>
                                window.location.href='index.php';
                            </script>
                        ";
                    }
                    else
                    {
                        alert('error','email verification failed');
                    }
                }
                else
                {
                    alert('error','Email is already registered');
                }
            }
        }
        else
        {
            alert('error','cannot run query');
        }

    }

?>