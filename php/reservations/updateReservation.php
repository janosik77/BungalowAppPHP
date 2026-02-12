<?php
    require "reservationFunc.php";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $idCustomer = $_POST['customer'];
        $idBungalow = $_POST['bungalow'];
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        $paymentMethod = $_POST['paymentMethod'];
        $earlyCheckIn = isset($_POST['earlyCheckIn']) ? 1 : 0;
        $lateCheckOut = isset($_POST['lateCheckOut']) ? 1 : 0;
        $notes = $_POST['notes'];

        updateReservationItem($id, $idCustomer, $idBungalow, $checkIn, $checkOut, $paymentMethod, $earlyCheckIn, $lateCheckOut, $notes);
        header("Location: ../../Views/reservations/reservations.php");
        exit();
    } else {
        exit("No reservation id provided");
    }
?>