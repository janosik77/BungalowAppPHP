<?php
    require_once __DIR__ . "/../server.php";

    function getAllBungalows(): mysqli_result {
        
        global $server;

        $query = "
            select
                bungalow.*,
                discount.name as discountName
            from
                bungalow
            left join
                discount
            on
                bungalow.id = discount.idBungalow
        ";

        $bungalows = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $bungalows;
    }

    function searchBungalows($searchQuery): mysqli_result{
        
        global $server;
        
        $query = "
            select
                bungalow.*,
                discount.name as discountName
            from
                bungalow
            left join
                discount
            on
                bungalow.id = discount.idBungalow
            where
                bungalow.name like '%$searchQuery%'
        ";

        $bungalows = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $bungalows;
    }

    function sortBungalows($sortQuery): mysqli_result{
        
        global $server;
        
        $query = "
            select
                bungalow.*,
                discount.name as discountName
            from
                bungalow
            left join
                discount
            on
                bungalow.id = discount.idBungalow
            order by
                $sortQuery
        ";

        $bungalows = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $bungalows;
    }

    function createBungalow($name, $pricePerNight, $capacity, $imagePath): void {
        
        global $server;
        
        $query = "
            insert into
                bungalow
            (
                name,
                pricePerNight,
                capacity,
                bungalowPath
            )
            values
            (
                '$name',
                $pricePerNight,
                $capacity,
                'assets/images/$imagePath'
            )
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");
    }

    function deleteBungalow($id): void {
        
        global $server;
        
        $query = "
            delete from
                bungalow
            where
                id = $id
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");
    }

    function updateBungalow($id, $name, $capacity, $pricePerNight, $imagePath): void {
        
        global $server;
        
        $query = "
            update
                bungalow
            set
                name = '$name',
                capacity = $capacity,
                pricePerNight = $pricePerNight,
                bungalowPath = 'assets/images/$imagePath'
            where
                id = $id
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");
        
    }

    function getBungalowById($id): array {
        
        global $server;
        
        $query = "
            select
                bungalow.*,
                discount.name as discountName
            from
                bungalow
            left join
                discount
            on
                bungalow.id = discount.idBungalow
            where
                bungalow.id = $id
        ";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query");

        $bungalow = mysqli_fetch_assoc($result);

        return $bungalow;
    }

    function getBungalowReservations($id): mysqli_result {
        global $server;

        $query = "
            select
                reservation.*,
                bungalow.name as bungalowName,
                users.name as userName,
                users.surname as userSurname,
                users.email as userEmail
            from
                reservation
            left join
                bungalow
            on
                reservation.idBungalow = bungalow.id
            left join
                users
            on
                reservation.idCustomer = users.id
            where
                reservation.idBungalow = $id
        ";

        $reservations = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $reservations;
    }
?>