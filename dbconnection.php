<?php

    $dbcon = mysqli_connect('localhost', 'pathanbd_courierdb', '', 'pathanbd_courierdb');
    if($dbcon==false)
    {
        echo "Database is not Connected!";
    }
   
?>