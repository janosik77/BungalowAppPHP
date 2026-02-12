<?php
    require 'discountFunctions.php';

    if(isset($_POST["deleteDiscount"])){
        deleteDiscount($_POST["deleteDiscount"]);
        header("Location: ../../Views/discounts/discounts.php");
    } else {
        echo "No discount to delete";
    }
?>