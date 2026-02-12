<?php

    require_once "bungalowsFunc.php";
    
    if(isset($_POST['submit']) && isset($_FILES['image'])){
        $name = $_POST["name"];
        $pricePerNight = $_POST["pricePerNight"];
        $capacity = $_POST["capacity"];
        $imagePath = $_FILES['image']['name'];
        $target = "../../assets/images/".basename($imagePath);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            createBungalow($name, $pricePerNight, $capacity, $imagePath);
            header("Location: ../../Views/bungalows/bungalows.php");
        } else {
            echo "Failed to upload image";
        }
    } else {
        echo "No data";
    }

?>