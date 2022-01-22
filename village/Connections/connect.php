<?php
$hostname_connet = "127.0.0.1";
$database_connet = "alert";
$username_connet = "admin";
$password_connet = "111111";
$link = mysqli_connect($hostname_connet, $username_connet, $password_connet,$database_connet) or die ('Fail'.mysqli_error()); 
mysqli_query($link, "set names 'utf8'");
// if($link){
//     echo "success";
// }
// else{
//     echo "fail";
// }
?>