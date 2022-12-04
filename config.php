<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dname = "customer";

    $conn = mysqli_connect($servername, $username , $password , $dname);

    if(!$conn){
        die("Could not connect to the database due to " . mysqli_connect_error());
    }



?>