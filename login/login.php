<?php

    if(isset($_POST['login'])){
        include '../dbconnector.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        
        //log file 
        $ip = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Calcutta');
        $time = date('m/d/y h:iA', time());
        $error_message = "Ip address:-$ip Date/Time:-$time Username:- $username password:- $password \n" ;
        $log_file = "./log.log"; 
        error_log($error_message, 3, $log_file);
        //log file close
        
        $sql = "SELECT * FROM `username` WHERE Username = 'admin'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        echo $num;
        if($num == 1){
            echo 'execute';
            while($row = mysqli_fetch_assoc($result))
            {   
                if(password_verify($password, $row['Password'])){
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("location: ../service/service.php");            
                }
                else{
                    echo "not exceute";
                }
            }
        } 
    
    }


?>
