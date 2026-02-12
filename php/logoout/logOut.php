<?php
    session_start();
    session_unset(); // usuwa wszystkie dane z sesji
    session_destroy(); // niszczy sesję

    header("Location: ../../index.php");
    exit;
?>