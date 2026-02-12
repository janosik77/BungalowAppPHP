<?php
    require "bungalowsFunc.php";

    if(isset($_POST['deleteBungalow'])){
        deleteBungalow($_POST['deleteBungalow']);
        header("location: ../../Views/bungalows/bungalows.php");
    } else {
        header("location: ../../Views/bungalows/bungalows.php");
    }
?>