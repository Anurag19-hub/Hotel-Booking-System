<?php

    $hname = 'localhost';
    $uname = 'root';
    $pass  = '';
    $db = 'serenityinn';

    $con = mysqli_connect($hname,$uname,$pass,$db);

    if(!$con){

        die("Can't connect to database".mysqli_connect_error());
    }

    function filteration($data)
    {
        foreach($data as $key => $value){

            $value = trim($value); // It removes the white spaces from the input field 
            $value = stripslashes($value); // It removes backward slashes            
            $value = strip_tags($value); //if user try to enter html tags and submit strip_tags() will remove that thing
            $value = htmlspecialchars($value); //It is use to convert special chars into html entity

            //$data[$key] = $value;
        }
        return $data;
    }

    function selectAll($table)
    {
        $con = $GLOBALS['con'];
        $res = mysqli_query($con, "SELECT * FROM $table");

        return $res;
    }


    //for all prepared statement we need to mysqli_prepare()statement, need to bind, and execute also
     //so we have made one function by using it we won't need to write again and again.
    function select($sql,$values,$datatypes)
    {    
        //we have use $GLOBALS bcz the variable $con is outside of this function so to use that we have use this
        $con = $GLOBALS['con'];

        if($stmt = mysqli_prepare($con,$sql))
        {
                           
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);    // ... is a splat operator which is use to bind multiple values dynamically
                                                        
            //mysqli_stmt_bind_param($stmt,$datatypes,$a,$b,$c etc..); like this we can't declare every time so we have used splat operator
            if(mysqli_stmt_execute($stmt))
            {                
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else
            {
                mysqli_stmt_close($stmt);
                die("Query Can not be executed - SELECT ");
            }    
        }
        else
        {
            die("Query Can not be Prepared - SELECT ");
        }
    }

    function update($sql,$values,$datatypes)
    {    
        //we have use $GLOBALS bcz the variable $con is outside of this function so to use that we have use this
        $con = $GLOBALS['con'];

        if($stmt = mysqli_prepare($con,$sql))
        {
                           
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);    // ... is a splat operator which is use to bind multiple values dynamically
                                                                    //mysqli_stmt_bind_param($stmt,$datatypes,$a,$b,$c etc..); like this we can't declare every time so we have used splat operator
            if(mysqli_stmt_execute($stmt))
            {                
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else
            {
                mysqli_stmt_close($stmt);
                die("Query Can not be executed - UPDATE ");
            }    
        }
        else
        {
            die("Query Can not be Prepared - UPDATE ");
        }
    }
    
    function insert($sql,$values,$datatypes)
    {            
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql))
        {                           
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt))
            {                
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else
            {
                mysqli_stmt_close($stmt);
                die("Query Can not be executed - INSERT ");
            }    
        }
        else
        {
            die("Query Can not be Prepared - INSERT ");
        }
    }

    function delete_data($sql, $values, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt))
            {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else
            {
                mysqli_stmt_close($stmt);
                die('Query cannot be executed - Delete');
            }        
        }
        else
        {
            die('Query cannot be prepared - Delete');
        }
    }
?>