<?php
    require_once "bungalowsFunc.php";

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $pricePerNight = $_POST['pricePerNight'];
        $capacity = $_POST['capacity'];
        
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

        updateBungalow($id, $name, $capacity, $pricePerNight, $image);

        header("Location: ../../Views/bungalows/bungalows.php");
    } else {
        exit("No bungalow id provided");
    }
?>