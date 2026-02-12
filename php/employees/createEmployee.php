<?php

    require "empFunc.php";
    

    if(isset($_POST["submit"]) && isset($_FILES["image"])){

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
        $employeeRole = $_POST["employeeRole"];

        $imagePath = $_FILES['image']['name'];
        $target = "../../assets/images/".basename($imagePath);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            addEmployee($name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $employeeRole, $imagePath);
            header("Location: ../../Views/employees/employees.php");
        } else {
            echo "Failed to upload image";
        }
    } else {
        echo "No data";
    }

?>