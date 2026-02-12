<?php  
        $server = mysqli_connect("localhost", "root", "","bungalows_db")
        or exit("Unable to connect to the database server");
        mysqli_set_charset($server, "utf8");
?>