<?php 
    require_once "empFunc.php";

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
        $employeeRole = $_POST['employeeRole'];

        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $target = "../assets/images/" . basename($image);
    
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
    
            $imagePath = "assets/images/" . $image;
        } else {
            // $image = $_POST['currentImage'];
            $image = $_POST['currentImage'];
            $image = str_replace('assets/images/', '', $image);
        }
        
        updateEmployee($id, $name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $employeeRole, $image);
        header("Location: ../../Views/employees/employees.php");
    } else {
        exit("No employee id provided");
    }
?>