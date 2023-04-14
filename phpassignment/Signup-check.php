<?php
session_start();
include"db_conn.php";
if(isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

   $uname = Validate ($_POST['uname']);
   $pass =  Validate ($_POST['password']);
  

   $re_pass =  Validate ($_POST['re_password']);
   $name =  Validate ($_POST['name']);
   $user_data = 'uname='. $uname. '&name=' . $name;

  



   if(empty($uname)){
        header("Location: signup.php?error= Please Enter Username&$user_data");
        exit();
   }    
   else if(empty($pass)){
            header("Location: signup.php?error= Please Enter Password&$user_data");
            exit();
    }
    else if(empty($re_pass)){
        header("Location: signup.php?error= Please Enter  Re Password&$user_data");
        exit();
    }
    else if(empty($name)){
        header("Location: signup.php?error= Please Enter  name&$user_data");
       exit();
    }

    else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
       exit();
    }


    else {

        $pass = md5($pass);

        $sql = "SELECT * FROM userss WHERE username= '$uname'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: signup.php?error=The username is taken try another&$user_data");
        exit();

        }else{
            $sql2 = "INSERT INTO userss (username,password,name) VALUES('$uname','$pass','$name')";

            $result2 = mysqli_query($conn, $sql2);
            if($result2){
                header("Location: signup.php?success=Your account has been created successfully");
                exit();

            }else{
                header("Location: signup.php?error=Unknown error occurred&$user_data");
                exit();
            }

        }
        
    }
}else {
    header("Location: signup.php?error= Incorrect user name or password");
    exit();
}