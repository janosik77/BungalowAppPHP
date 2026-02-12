<?php
require_once __DIR__ . "/../server.php";
require_once __DIR__ . "/../bungalows/bungalowsFunc.php";

    function getReservationsForTable(): mysqli_result|bool
    {
        global $server;

        $query = "
            SELECT
                reservation.*,
                bungalow.name AS bungalowName,
                users.name AS userName,
                users.surname AS userSurname,
                users.email AS userEmail
            FROM
                reservation
            JOIN
                bungalow
            ON
                reservation.idBungalow = bungalow.id
            JOIN
                customer
            ON
                reservation.idCustomer = customer.id
            JOIN
                users
            ON
                customer.idUser = users.id
        ";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        return $result;
    }

    function createReservation($idCustomer, $idBungalow, $checkIn, $checkOut, $paymentMethod, $earlyCheckIn, $lateCheckOut): void
    {
        
        global $server;

        $createdAt = date("Y-m-d H:i:s");

        $bungalow = getBungalowById($idBungalow);

        $amount = calculateReservationAmount($checkIn, $checkOut, $bungalow['pricePerNight']);

        $status = "completed";

        var_dump($paymentMethod); 

        $query = "
            INSERT INTO
                reservation
            (
                idCustomer,
                idBungalow,
                checkIn,
                checkOut,
                amount,
                paymentMethodId,
                earlyCheckInRequest,
                lateCheckOutRequest,
                createdAt,
                reservationStatus
            )
            VALUES
            (
                $idCustomer,
                $idBungalow,
                '$checkIn',
                '$checkOut',
                $amount,
                $paymentMethod,
                $earlyCheckIn,
                $lateCheckOut,
                '$createdAt',
                '$status'
            )
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    }

    function calculateReservationAmount($checkIn, $checkOut, $bungalowPrice): int
    {
        $checkIn = new DateTime($checkIn);
        $checkOut = new DateTime($checkOut);

        $interval = $checkIn->diff($checkOut);

        $days = $interval->days;

        $amount = $days * $bungalowPrice;

        return $amount;
    }

    function searchReservations($searchQuery): mysqli_result{
        
        global $server;
        
        $query = "
            SELECT
                reservation.*,
                bungalow.name AS bungalowName,
                users.name AS userName,
                users.surname AS userSurname,
                users.email AS userEmail
            FROM
                reservation
            JOIN
                bungalow
            ON
                reservation.idBungalow = bungalow.id
            JOIN
                customer
            ON
                reservation.idCustomer = customer.id
            JOIN
                users
            ON
                customer.idUser = users.id
            WHERE
                bungalow.name LIKE '%$searchQuery%'
                OR
                users.name LIKE '%$searchQuery%'
                OR
                users.surname LIKE '%$searchQuery%'
                OR
                users.email LIKE '%$searchQuery%'
        ";

        $reservations = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
        
        return $reservations;
    }

    function sortReservations($sortQuery): mysqli_result{
        
        global $server;

        $columnsToSort = [
            "name" => "bungalow.name",
            "checkIn" => "reservation.checkIn",
            "checkOut" => "reservation.checkOut",
            "amount" => "reservation.amount",
            "reservationStatus" => "reservation.reservationStatus"
        ];

        $orderBy = $columnsToSort[$sortQuery];

        $query = "
            SELECT
                reservation.*,
                bungalow.name AS bungalowName,
                users.name AS userName,
                users.surname AS userSurname,
                users.email AS userEmail
            FROM
                reservation
            JOIN
                bungalow
            ON
                reservation.idBungalow = bungalow.id
            JOIN
                customer
            ON
                reservation.idCustomer = customer.id
            JOIN
                users
            ON
                customer.idUser = users.id
            ORDER BY
                $orderBy
        ";

        $reservations = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
        
        return $reservations;
    }

    function delReservation($id): void
    {
        
        global $server;

        $query = "
            DELETE FROM
                reservation
            WHERE
                id = $id
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    }

    function getReservationById($id): array {
        
        global $server;
        
        $query = "
            SELECT
                reservation.*,
                bungalow.name AS bungalowName,
                bungalow.bungalowPath as bungalowPath,
                users.name AS userName,
                users.surname AS userSurname,
                users.email AS userEmail,
                users.phone_number AS userPhoneNumber
            FROM
                reservation
            JOIN
                bungalow
            ON
                reservation.idBungalow = bungalow.id
            JOIN
                customer
            ON
                reservation.idCustomer = customer.id
            JOIN
                users
            ON
                customer.idUser = users.id
            WHERE
                reservation.id = $id
        ";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $reservation = mysqli_fetch_assoc($result);

        return $reservation;
    }

    function updateReservationItem($id, $idCustomer, $idBungalow, $checkIn, $checkOut, $paymentMethod, $earlyCheckIn, $lateCheckOut, $notes): void
    {
        global $server;

        $bungalow = getBungalowById($idBungalow);

        $amount = calculateReservationAmount($checkIn, $checkOut, $bungalow['pricePerNight']);

        $status = "completed";

        $query = "
            UPDATE
                reservation
            SET
                idCustomer = $idCustomer,
                idBungalow = $idBungalow,
                checkIn = '$checkIn',
                checkOut = '$checkOut',
                amount = $amount,
                paymentMethodId = $paymentMethod,
                earlyCheckInRequest = $earlyCheckIn,
                lateCheckOutRequest = $lateCheckOut,
                reservationStatus = '$status',
                notes = '$notes'
            WHERE
                id = $id
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
    }
?>