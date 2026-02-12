<?php
    require_once 'customerFunc.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $street = $_POST['street'];
        $streetNumber = $_POST['streetNumber'];
        $houseNumber = $_POST['houseNumber'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postalCode = $_POST['postalCode'];
        $nationality = $_POST['nationality'];

        updateCustomer($id, $name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $nationality);
        header("Location: ../../Views/customers/customers.php");
    } else {
        exit("No customer id provided");
    }
?>