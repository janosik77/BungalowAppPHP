<?php
    require 'customerFunc.php';

    if(isset($_POST["deleteCustomer"])){
        deleteCustomer($_POST["deleteCustomer"]);
        header("Location: ../../Views/customers/customers.php");
    } else {
        echo "No customer to delete";
    }
?>