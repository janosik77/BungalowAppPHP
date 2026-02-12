<?php
    require_once __DIR__ . "/../server.php";

    function verifyLogin($login, $password){

        global $server;
        // wyszukanie pracownika o podanym loginie
        // używamy prepared statements, aby zabezpieczyć się przed SQL injection
        
        $query = "
        SELECT 
            employee.*, 
            users.name AS employeeName, 
            users.surname AS employeeSurname, 
            users.email AS employeeEmail, 
            address.street AS employeeStreet, 
            address.street_number AS employeeStreetNumber, 
            address.city AS employeeCity, 
            address.postal_code AS employeePostalCode, 
            address.country AS employeeCountry, 
            role.roleName AS role
        FROM 
            employee
        JOIN 
            users 
        ON 
            employee.idUser = users.id
        JOIN 
            address 
        ON 
            users.addressId = address.id
        JOIN 
            role 
        ON 
            employee.roleId = role.id
        WHERE 
            employee.login = ?
    ";
        $stmt = mysqli_prepare($server, $query);

        // s - string
        // mysqli_stmt_bind_param przypisuje wartość zmiennej login do ? w zapytaniu
        mysqli_stmt_bind_param($stmt, 's', $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        // mysqli_fetch_assoc zwraca jeden wiersz wyniku jako tablicę asocjacyjną (klucze to nazwy kolumn z bazy danych).
        if ($row = mysqli_fetch_assoc($result)) {
            // sprawdzanie hasła
            if (hash_equals($row['password'], hash('sha256', $password))) {
                return $row; // Zwraca w przypadku sukcesu
            }
        }

    }
?>