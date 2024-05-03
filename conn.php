<?php

$conn = new mysqli("localhost", "root" , "" ,"mydb");

if($conn->connect_error){
    echo $connect_error;
}

?>