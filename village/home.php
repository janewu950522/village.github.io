<?php
session_start();
if(isset($_SESSION['home']) && $_SESSION['home']=="red"){
    echo'<script>alert("測試警報！");</script>
    <form method="post" action="index.php">
    <hr>
    <center><input type="submit" name="home" value="Home Get"></center>
    </form>';
}
if(isset($_SESSION['home']) && $_SESSION['home']=="yellow"){
    echo'<script>alert("測試次級警報！");</script>
    <form method="post" action="index.php">
    <hr>
    <center><input type="submit" name="home" value="Home Get2"></center>
    </form>';
}

?>