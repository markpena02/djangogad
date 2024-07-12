<?php
    $servername="localhost";
    $username="root";
    $password="";
    //$databasename="gadsystem_db4";
    $databasename="gad_db";
    $connection = mysqli_connect($servername, $username, $password, $databasename);
    if(!$connection)
    die("Can't connect to database ". mysqli_connect_error());
?>
