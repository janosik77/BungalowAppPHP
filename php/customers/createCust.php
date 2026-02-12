<?php

    require "customerFunc.php";
    

    if(isset($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["phoneNumber"], $_POST["street"], $_POST["streetNumber"], $_POST["houseNumber"], $_POST["city"], $_POST["country"], $_POST["postalCode"], $_POST["nationality"])){

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $street = $_POST["street"];
        $streetNumber = $_POST["streetNumber"];
        $houseNumber = $_POST["houseNumber"];
        $city = $_POST["city"];
        $country = $_POST["country"];
        $postalCode = $_POST["postalCode"];
        $nationality = $_POST["nationality"];

        addCustomer($name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $nationality);
        header("Location: ../../Views/customers/customers.php");
    } else {
        echo "No data";
    }

?>