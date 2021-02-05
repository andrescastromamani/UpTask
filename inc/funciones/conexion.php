<?php 

    $conn = new mysqli('localhost','root','','uptask','33066');
    if($conn->connect_error){
        echo $conn->connect_error;
    }
    $conn->set_charset('utf8');//Para caracteres con acento etc