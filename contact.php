<?php
if(isset($_POST['contact'])){
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $feedback = $_POST["feedback"];
     
    $to = "himanshu.s2299@gmail.com";
    $subject = "Important message";
    $txt = $feedback;
    $headers = "From:-".$email."\n Phone:-".$phone. "\n name:-". $firstname." ".$lastname;
    if (mail($to,$subject,$message,$headers)) {
        header("location: index.html?email send");
    }
    else {
        header("location: index.html?email not send");
    }
}
?>