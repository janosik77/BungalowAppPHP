<?php
    require_once '../reservations/reservationFunc.php';

    header('Content-Type: text/txt');
    header('Content-Disposition: attachment; filename="reservation.txt"');

    $output = fopen('php://output', 'w');

    if (isset($_GET['exportReservationItem'])) {
        $id = $_GET['exportReservationItem'];
        $selectedReservation = getReservationById($id);
    
        // if rez została znaleziona zapisz
        if ($selectedReservation) {
            fputcsv($output, ['Reservation ID: ' . $selectedReservation['id']]);
            fputcsv($output, ['Bungalow Name: ' . $selectedReservation['bungalowName']]);
            fputcsv($output, ['Amount: ' . $selectedReservation['amount']]);
            fputcsv($output, ['Status: ' . $selectedReservation['reservationStatus']]);
            fputcsv($output, ['Customer Name: ' . $selectedReservation['userName'] . ' ' . $selectedReservation['userSurname']]);
            fputcsv($output, ['Phone: ' . $selectedReservation['userPhoneNumber']]);
            fputcsv($output, ['Email: ' . $selectedReservation['userEmail']]);
        } else {
            fputcsv($output, ['No data available for this reservation']);
        }
    } else {
        fputcsv($output, ['No reservation ID provided']);
    }
    

    fclose($output);
?>