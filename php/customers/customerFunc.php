<?php
    require_once __DIR__ . "/../server.php";

    function getCustomersForTable(): mysqli_result {
        
        global $server;

        $query = "
            select
                customer.*,
                users.name as customerName,
                users.surname as customerSurname,
                users.email as customerEmail,
                users.phone_number as customerPhoneNumber,
                address.street as customerStreet,
                address.street_number as customerStreetNumber,
                address.city as customerCity,
                address.postal_code as customerPostalCode,
                address.country as customerCountry
            from
                customer
            join
                users
            on
                customer.idUser = users.id
            join
                address
            on
                users.addressId = address.id

        ";

        $customer = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $customer;
    }

    function addCustomer($name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $nationality): void {

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

        $address = mysqli_query($server, $query)
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

        $user = mysqli_query($server, $query)
            or exit("Unable to execute query");

        $userId = mysqli_insert_id($server);

        $query = "
            insert into
                customer
            (
                idUser,
                nationality
            )
            values
            (
                $userId,
                '$nationality'
            )
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");

    }

    function searchCustomers($searchQuery): mysqli_result {
        
        global $server;

        $query = "
            select
                customer.*,
                users.name as customerName,
                users.surname as customerSurname,
                users.email as customerEmail,
                users.phone_number as customerPhoneNumber,
                address.street as customerStreet,
                address.street_number as customerStreetNumber,
                address.city as customerCity,
                address.postal_code as customerPostalCode,
                address.country as customerCountry
            from
                customer
            join
                users
            on
                customer.idUser = users.id
            join
                address
            on
                users.addressId = address.id
            where
                users.name like '%$searchQuery%'
                or
                users.surname like '%$searchQuery%'
                or
                users.email like '%$searchQuery%'
                or
                users.phone_number like '%$searchQuery%'
                or
                address.street like '%$searchQuery%'
                or
                address.city like '%$searchQuery%'
                or
                address.country like '%$searchQuery%'
        ";

        $customer = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $customer;
    }

    function sortCustomers($searchQuery): mysqli_result {
        
        global $server;
        
        $query = "
            select
                customer.*,
                users.name as customerName,
                users.surname as customerSurname,
                users.email as customerEmail,
                users.phone_number as customerPhoneNumber,
                address.street as customerStreet,
                address.street_number as customerStreetNumber,
                address.city as customerCity,
                address.postal_code as customerPostalCode,
                address.country as customerCountry
            from
                customer
            join
                users
            on
                customer.idUser = users.id
            join
                address
            on
                users.addressId = address.id
            order by
                $searchQuery
        ";

        $customer = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $customer;
    }

    function deleteCustomer($id): void {
        
        global $server;
         
        $query = "
            SELECT
                idUser
            FROM
                customer
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
                customer
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

    function getCustomerById($id): array {
        
        global $server;
        
        $query = "
            SELECT
                customer.*,
                users.name as customerName,
                users.surname as customerSurname,
                users.email as customerEmail,
                users.phone_number as customerPhoneNumber,
                address.street as customerStreet,
                address.street_number as customerStreetNumber,
                address.house_number as customerHouseNumber,
                address.city as customerCity,
                address.postal_code as customerPostalCode,
                address.country as customerCountry
            FROM
                customer
            JOIN
                users
            ON
                customer.idUser = users.id
            JOIN
                address
            ON
                users.addressId = address.id
            WHERE
                customer.id = $id
        ";
    
        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    
        $customer = mysqli_fetch_assoc($result);
    
        return $customer;
    }
    
    function updateCustomer($id, $name, $surname, $email, $phoneNumber, $street, $streetNumber, $houseNumber, $city, $country, $postalCode, $nationality): void {
        
        global $server;
        
        $query = "
            SELECT
                idUser
            FROM
                customer
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
            UPDATE
                address
            SET
                street = '$street',
                street_number = '$streetNumber',
                house_number = '$houseNumber',
                city = '$city',
                country = '$country',
                postal_code = '$postalCode'
            WHERE
                id = $addressId
        ";
        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    
        $query = "
            UPDATE
                users
            SET
                name = '$name',
                surname = '$surname',
                email = '$email',
                phone_number = '$phoneNumber'
            WHERE
                id = $idUser
        ";
        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    
        $query = "
            UPDATE
                customer
            SET
                nationality = '$nationality'
            WHERE
                id = $id
        ";
        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    }
?>