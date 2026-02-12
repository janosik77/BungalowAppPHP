<?php
    require_once __DIR__ . "/server.php";

    function getAllEmployeeRoles(): mysqli_result {
        
        global $server;

        $query = "
            select * from role
        ";

        $role = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $role;
    }


?>