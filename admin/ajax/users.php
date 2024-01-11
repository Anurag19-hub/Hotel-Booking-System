<?php

    require('../inc/essential.php');
    require('../inc/db_config.php');
    adminLogin();
    

    if(isset($_POST['get_users']))
    {
        $res = selectAll('user_cred');
        $i = 1;


        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
                            <i class='bi bi-trash'></i>
                        </button>";
            $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";

            if($row['is_verified'])
            {
                $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
                $del_btn ="";
            }

            $date = date("d-m-Y", strtotime($row["datentime"]));

            $data.="
                <tr>
                    <td>$i</td>
                    <td>$row[full_name]</td>
                    <td>$row[username]</td>
                    <td>$row[email]</td>
                    <td>$verified</td>
                    <td>$date</td>
                    <td>$del_btn</td>
                </tr>
            ";
            $i++;
        }
        echo $data;
    }


    
    if(isset($_POST['remove_user']))
    {
        $frm_data = filteration($_POST);

        $res = delete_data("DELETE FROM `user_cred` WHERE `id`=? AND `is_verified`=? ",[$frm_data['user_id'],0],'ii');        

        if($res)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

    }



    // if(isset($_POST['search_user']))
    // {
    //     $frm_data = filteration($_POST);

    //     $query = "SELECT * FROM `user_cred` WHERE `username` LIKE ?";

    //     $res = select($query,["%$frm_data[username]%"],'s');
    //     $i = 1;


    //     $data = "";

    //     while($row = mysqli_fetch_assoc($res))
    //     {
    //         $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
    //                         <i class='bi bi-trash'></i>
    //                     </button>";
    //         $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";

    //         if($row['is_verified'])
    //         {
    //             $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
    //             $del_btn ="";
    //         }

    //         $date = date("d-m-Y", strtotime($row["datentime"]));

    //         $data.="
    //             <tr>
    //                 <td>$i</td>
    //                 <td>$row[full_name]</td>
    //                 <td>$row[username]</td>
    //                 <td>$row[email]</td>
    //                 <td>$verified</td>
    //                 <td>$date</td>
    //                 <td>$del_btn</td>
    //             </tr>
    //         ";
    //         $i++;
    //     }
    //     echo $data;
    // }

?>