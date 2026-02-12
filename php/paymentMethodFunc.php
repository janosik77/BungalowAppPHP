<?php
    require_once __DIR__ . "/server.php";

    function getAllPaymentMethods(): mysqli_result {
        global $server;

        $query = "
            select * from paymentmethod
        ";

        $paymentMethod = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $paymentMethod;
    }


?>