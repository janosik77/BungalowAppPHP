<?php
    
    require "discountFunctions.php";
    

    if(isset($_POST["bungalow"], $_POST["validFrom"], $_POST["validTo"], $_POST["promoName"], $_POST["discount"], $_POST["description"])){

        $bungalowId = $_POST["bungalow"];
        $validFrom = $_POST["validFrom"];
        $validTo = $_POST["validTo"];
        $name = $_POST["promoName"];
        $discount = $_POST["discount"];
        $description = $_POST["description"];

        addDiscount($bungalowId, $validFrom, $validTo, $name, $discount, $description);
        header("Location: ../../Views/discounts/discounts.php");
    } else {
        echo "No data";
    }
?>