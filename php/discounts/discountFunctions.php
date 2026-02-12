<?php
    require_once __DIR__ . "/../server.php";

    function getDiscountsForTable(): mysqli_result {
        global $server;

        $query = "
            select
                discount.*,
                bungalow.name as bungalowName
            from
                discount
            join
                bungalow
            on
                discount.idBungalow = bungalow.id
        ";

        $discounts = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $discounts;
    }

    function addDiscount($bungalowId, $validFrom, $validTo, $name, $discount, $description): void {
        
        global $server;

            $query = "
                insert into
                    discount
                (
                    idBungalow,
                    validFrom,
                    validTo,
                    name,
                    discount,
                    description
                )
                values
                (
                    '$bungalowId',
                    '$validFrom',
                    '$validTo',
                    '$name',
                    '$discount',
                    '$description'
                )
            ";

            mysqli_query($server, $query)
                or exit("Unable to execute query");

    }

    function searchDiscounts($searchQuery): mysqli_result {
        
        global $server;

        $query = "
            select
                discount.*,
                bungalow.name as bungalowName
            from
                discount
            join
                bungalow
            on
                discount.idBungalow = bungalow.id
            where
                discount.name like '%$searchQuery%'
            or
                discount.description like '%$searchQuery%'
            or
                bungalow.name like '%$searchQuery%'
        ";

        $discounts = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $discounts;
    }

    function sortDiscounts($sortQuery): mysqli_result {
        
        global $server;

        $query = "
            select
                discount.*,
                bungalow.name as bungalowName
            from
                discount
            join
                bungalow
            on
                discount.idBungalow = bungalow.id
        ";

        $columnsToSort = [
            'name' => 'discount.name',
            'validPeriod' => 'discount.validFrom',
            'discount' => 'discount.discount',
            'description' => 'discount.description',
            'bungalowName' => 'bungalow.name'
        ];

        if (array_key_exists($sortQuery, $columnsToSort)) {
            $query .= "
                order by
                    $columnsToSort[$sortQuery]
            ";
        }


        $discounts = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return $discounts;
    }

    function deleteDiscount($id): void {
        
        global $server;

        $query = "
            delete from
                discount
            where
                id = $id
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");
    }

    function getDiscountById($id):array {
        
        global $server;

        $query = "
            select
                discount.*,
                bungalow.name as bungalowName
            from
                discount
            join
                bungalow
            on
                discount.idBungalow = bungalow.id
            where
                discount.id = $id
        ";

        $discount = mysqli_query($server, $query)
            or exit("Unable to execute query");

        return mysqli_fetch_assoc($discount);
    }

    function updateDisciunt($id, $bungalowId, $validFrom, $validTo, $name, $discount, $description): void {
        
        global $server;

        $query = "
            update
                discount
            set
                idBungalow = '$bungalowId',
                validFrom = '$validFrom',
                validTo = '$validTo',
                name = '$name',
                discount = '$discount',
                description = '$description'
            where
                id = $id
        ";

        mysqli_query($server, $query)
            or exit("Unable to execute query");
    }
?>