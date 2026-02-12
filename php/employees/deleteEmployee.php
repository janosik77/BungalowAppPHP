<?php
    require "empFunc.php";

    if(isset($_POST['deleteEmployee'])){
        deleteEmployee($_POST['deleteEmployee']);
        header("Location: ../../Views/employees/employees.php");
    } else {
        echo "No employee selected";
    }
?>