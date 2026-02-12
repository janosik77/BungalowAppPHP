<?php
    require_once __DIR__ . "/server.php";

    function getAllReservations(): mysqli_result {
        global $server;

        $query1 = "Select * from reservation";

        $reservations = mysqli_query($server, $query1)
            or exit("Unable to execute query");

        return $reservations;
    }

    function getAllBungalows(): mysqli_result  {
        global $server;

        $query2 = "Select * from bungalow";

        $bungalows = mysqli_query($server, $query2)
            or exit("Unable to execute query");

        return $bungalows;
    }

    function calcReservations(): int {
        global $server;

        $numOfDays = 30;
    
        $query = "SELECT COUNT(*) as nReservations FROM reservation WHERE createdAt >= DATE_SUB(CURDATE(), INTERVAL $numOfDays DAY)";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $row = mysqli_fetch_assoc($result);

        if (!$row || !isset($row['nReservations'])) {
            return 0;
        }
    
        return (int)$row['nReservations'];
    }

    function calcCheckIns() : int {
        global $server;

        $numOfDays = 30;

        $query = "SELECT COUNT(*) as numCheckIns FROM reservation WHERE checkIn >= DATE_SUB(CURDATE(), INTERVAL $numOfDays DAY)";

        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));

        $row = mysqli_fetch_assoc($result);

        if (!$row || !isset($row['numCheckIns'])) {
            return 0;
        }

        return (int)$row['numCheckIns'];
    }

    function calcOccupancyRate() : float {
        global $server;
 
        $numOfDays = 30;

        $nReservations = calcReservations();

        $query = "SELECT COUNT(*) as nBungalows FROM bungalow";
        $result = mysqli_query($server, $query)
            or exit("Unable to execute query: " . mysqli_error($server));
        $row = mysqli_fetch_assoc($result);

        if (!$row || !isset($row['nBungalows'])) {
            return 0;
        }
        $nBungalows = (int)$row['nBungalows'];

        if ($nBungalows == 0) {
            return 0;
        }
        return number_format(($nReservations / $nBungalows) * 100, 2);
    }
?>