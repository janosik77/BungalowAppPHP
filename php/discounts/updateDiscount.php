<?php
    require_once "discountFunctions.php";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $bungalowId = $_POST['bungalow'];
        $validFrom = $_POST['validFrom'];
        $validTo = $_POST['validTo'];
        $name = $_POST['promoName'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];

        updateDisciunt($id, $bungalowId, $validFrom, $validTo, $name, $discount, $description);
        header("Location: ../../Views/discounts/discounts.php");
    } else {
        exit("No discount id provided");
    }
?>