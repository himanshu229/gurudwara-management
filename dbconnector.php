<?php
$server ="localhost";
$username = "root";
$password = "";
$database = "gurudwara";

$conn = mysqli_connect($server, $username, $password, $database);
if($conn){
    echo "";
}
else
{
    die("error". mysquli_connect_error());
}
?>