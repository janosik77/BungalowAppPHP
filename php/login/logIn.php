<?php
    session_start();
    require_once './logFunc.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $login = $_POST['login'];
        $password = $_POST['password'];

        $employee = verifyLogin($login, $password);

        $errors = [];

        if(empty($login)){
            $errors['login'] = "Please enter a login";
        } else if($employee == null){
            $errors['login'] = "Invalid login or password";
        }

        if(empty($password)){
            $errors['password'] = "Please enter a password";
        } else if($employee == null){
            $errors['password'] = "Invalid login or password";
        }

        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            header("Location: ../../index.php");
            exit;
        }

        if($employee){
            $_SESSION['employee'] = $employee;
            header("Location: ../../Views/home/home.php");
        } else {
            echo "Invalid login or password";
        }
    }
?>  