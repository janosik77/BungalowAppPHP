<?php
    session_start();
    require "reservationFunc.php";
    

    if(isset($_POST["customer"], $_POST["bungalow"], $_POST["checkIn"], $_POST["checkOut"], $_POST["paymentMethod"])){

        $idCustomer = $_POST["customer"];
        $idBungalow = $_POST["bungalow"];
        $checkIn = $_POST["checkIn"];
        $checkOut = $_POST["checkOut"];
        $paymentMethod = $_POST["paymentMethod"];
        $notes = $_POST["notes"];

        if(empty($_POST["earlyCheckIn"])){$earlyCheckIn = 0;} else {$earlyCheckIn = 1;}
        if(empty($_POST["lateCheckOut"])){$lateCheckOut = 0;} else {$lateCheckOut = 1;}

        $errors = [];

        if(empty($idBungalow)){
            $errors['bungalow'] = "Please select an bungalow";
        }

        if(empty($idCustomer)){
            $errors['customer'] = "Please select a customer";
        }

        if(empty($paymentMethod)){
            $errors['paymentMethod'] = "Please select a payment method";
        }

        if(empty($checkIn) || !strtotime($checkIn)){
            $errors['checkIn'] = "Please select a valid check in date";
        } else if($checkIn < date("Y-m-d")){
            $errors['checkIn'] = "Check in date must be in the future";
        }


        if(empty($checkOut) || !strtotime($checkOut)){
            $errors['checkOut'] = "Please select a valid check out date";
        } else if($checkOut < date("Y-m-d")){
            $errors['checkOut'] = "Check out date must be in the future";
        }

        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            $_SESSION['formData'] = $_POST;
            header("Location: ../../Views/reservations/addReservation.php");
            exit;
        }

        createReservation($idCustomer, $idBungalow, $checkIn, $checkOut, $paymentMethod, $earlyCheckIn, $lateCheckOut);
        header("Location: ../../Views/reservations/reservations.php");
    } else {
        echo "No data";
    }
?>