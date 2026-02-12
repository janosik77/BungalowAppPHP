<?php
    require_once __DIR__ . "/../server.php";

    function getEmployeesForTable(): mysqli_result {
        
        global $server;

        $query = "
            select
                employee.*,
                users.name as employeeName,
                users.surname as employeeSurname,
                users.email as employeeEmail,
                address.street as employeeStreet,
                address.street_number as employeeStreetNumber,
                address.city as employeeCity,
                address.postal_code as employeePostalCode,
                address.country as employeeCountry,
                role.roleName as role
            from
                employee
            join
                users
            on
                employee.idUser = users.id
            join
                address
            on
                users.addressId = address.id
            join
                role
            on
                employee.roleId = role.id

        ";

        $employee = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $employee;
    }

    function addEmployee($name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $role, $image): void{

        global $server; 

        $createdAt = date("Y-m-d H:i:s");

        $query = "
            insert into
                address
            (
                street,
                street_number,
                house_number,
                city,
                country,
                postal_code
            )
            values
            (
                '$street',
                '$streetNumber',
                '$houseNumber',
                '$city',
                '$country',
                '$postalCode'
            )
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");

        $addressId = mysqli_insert_id($server);

        $query = "
            insert into
                users
            (
                name,
                surname,
                email,
                phone_number,
                addressId,
                createdAt
            )
            values
            (
                '$name',
                '$surname',
                '$email',
                '$phoneNumber',
                $addressId,
                '$createdAt'
            )
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");

        $userId = mysqli_insert_id($server);

        $query = "
            insert into
                employee
            (
                idUser,
                roleId,
                imagePath
            )
            values
            (
                $userId,
                $role,
                'assets/images/$image'
            )
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");

    }

    function searchEmployees($searchQuery): mysqli_result{
        
        global $server;
        
        $query = "
            select
                employee.*,
                users.name as employeeName,
                users.surname as employeeSurname,
                users.email as employeeEmail,
                address.street as employeeStreet,
                address.street_number as employeeStreetNumber,
                address.city as employeeCity,
                address.postal_code as employeePostalCode,
                address.country as employeeCountry,
                role.roleName as role
            from
                employee
            join
                users
            on
                employee.idUser = users.id
            join
                address
            on
                users.addressId = address.id
            join
                role
            on
                employee.roleId = role.id
            where
                users.name like '%$searchQuery%'
                or
                users.surname like '%$searchQuery%'
                or
                users.email like '%$searchQuery%'
                or
                address.street like '%$searchQuery%'
                or
                address.city like '%$searchQuery%'
                or
                address.country like '%$searchQuery%'
                or
                role.roleName like '%$searchQuery%'
        ";

        $employee = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $employee;
    }

    function sortEmployees($searchQuery) :mysqli_result {
        
        global $server;
        
        $query = "
            select
                employee.*,
                users.name as employeeName,
                users.surname as employeeSurname,
                users.email as employeeEmail,
                address.street as employeeStreet,
                address.street_number as employeeStreetNumber,
                address.city as employeeCity,
                address.postal_code as employeePostalCode,
                address.country as employeeCountry,
                role.roleName as role
            from
                employee
            join
                users
            on
                employee.idUser = users.id
            join
                address
            on
                users.addressId = address.id
            join
                role
            on
                employee.roleId = role.id
            order by
                $searchQuery
        ";

        $employee = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $employee;
    }

    function deleteEmployee($id): void {
        
        global $server;
        
        $query = "
            SELECT
                idUser
            FROM
                employee
            WHERE
                id = $id
        ";
        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
        $user = mysqli_fetch_assoc($result);
    
        $idUser = $user['idUser'];
    
        $query = "
            SELECT
                addressId
            FROM
                users
            WHERE
                id = $idUser
        ";
        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
        $address = mysqli_fetch_assoc($result);
    
        if (!$address) {
            exit("No user found with the provided ID.");
        }
        $addressId = $address['addressId'];
    
        $query = "
            DELETE FROM
                employee
            WHERE
                id = $id
        ";
        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    
        $query = "
            DELETE FROM
                users
            WHERE
                id = $idUser
        ";
        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    
        $query = "
            DELETE FROM
                address
            WHERE
                id = $addressId
        ";
        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    }

    function getEmployeeById($id): array {
        
        global $server;
        
        $query = "
            select
                employee.*,
                users.name as employeeName,
                users.surname as employeeSurname,
                users.email as employeeEmail,
                users.phone_number as employeePhoneNumber,
                address.street as employeeStreet,
                address.street_number as employeeStreetNumber,
                address.house_number as employeeHouseNumber,
                address.city as employeeCity,
                address.postal_code as employeePostalCode,
                address.country as employeeCountry,
                role.roleName as role
            from
                employee
            join
                users
            on
                employee.idUser = users.id
            join
                address
            on
                users.addressId = address.id
            join
                role
            on
                employee.roleId = role.id
            where
                employee.id = $id
        ";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $employee = mysqli_fetch_assoc($result);

        return $employee;
    }

    function updateEmployee($id, $name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $role, $image): void {
        
        global $server;
        
        $query = "
            select
                idUser
            from
                employee
            where
                id = $id
        ";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $user = mysqli_fetch_assoc($result);

        $idUser = $user['idUser'];

        $query = "
            select
                addressId
            from
                users
            where
                id = $idUser
        ";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $address = mysqli_fetch_assoc($result);

        $addressId = $address['addressId'];

        $query = "
            update
                address
            set
                street = '$street',
                street_number = '$streetNumber',
                house_number = '$houseNumber',
                city = '$city',
                country = '$country',
                postal_code = '$postalCode'
            where
                id = $addressId
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $query = "
            update
                users
            set
                name = '$name',
                surname = '$surname',
                email = '$email',
                phone_number = '$phoneNumber'
            where
                id = $idUser
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $query = "
            update
                employee
            set
                roleId = $role,
                imagePath = 'assets/images/$image'
            where
                id = $id
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    }
?>