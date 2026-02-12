<?php
    require "reservationFunc.php";

    if(isset($_POST['delReservation'])){
        delReservation($_POST['delReservation']);
        header("Location: ../../Views/reservations/reservations.php");
    } else {
        header("Location: ../../Views/reservations/reservations.php");
    }
?>