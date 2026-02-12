<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Evergreen Bungalows</title>
		<link rel="shortcut icon" type="image/png" href="../../assets/images/logo.png" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;700&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="../../css/main.css" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
			crossorigin="anonymous" />
	</head>

	<?php
		session_start();
		require "../../php/reservations/reservationFunc.php";
		require_once "../../php/bungalows/bungalowsFunc.php";
		require "../../php/customers/customerFunc.php";
		require "../../php/paymentMethodFunc.php";
		
		


        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $reservation = getReservationById($id);
            if(!$reservation){
                exit("Reservation not found");
            }
        } else {
            exit("No reservation id provided");
        }

		// $reservations = getReservationsForTable();
		$bungalows = getAllBungalows();
		$customers = getCustomersForTable();
		$paymentMethods = getAllPaymentMethods();
	?>

	<body>
	<nav class="navbar navbar-expand-lg">
			<div class="wrapper d-flex justify-content-between navbar-container container-fluid">
				<a class="navbar-brand d-flex align-items-center" href="../home/home.php">
					<img
						src="../../assets/images/logo.png"
						alt="Logo"
						width="40"
						height="40"
						class="d-inline-block align-text-top me-2" />
					Evergreen Bungalows
				</a>
				<button
					class="navbar-toggler custom-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navbarNavAltMarkup"
					aria-controls="navbarNavAltMarkup"
					aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-link" href="../home/home.php">Home</a>
						<a class="nav-link active" href="../reservations/reservations.php">Reservations</a>
						<a class="nav-link" href="../bungalows/bungalows.php">Bungalows</a>
						<a class="nav-link" href="../employees/employees.php">Employees</a>
						<a class="nav-link" href="../customers/customers.php">Customers</a>
						<a class="nav-link" href="../discounts/discounts.php">Discounts</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="wrapper">
			<div class="row">
				<div class="col-12">
					<main class="main">
						<?php 
						require "../includes/header.php";
						?>
						<section class="section section__reservations mt-5">
							<div class="heading d-flex justify-content-between mb-5">
								<h1>Edit reservation</h1>
							</div>
						</section>

						<section class="section section__form">
							<form action="../../php/reservations/updateReservationItem.php" method="post" class="form">
                                <input type="hidden" name="id" value="<?php echo $reservation['id']; ?>" />
								<div class="input-container">
									<label for="customer">Select customer</label>
									<select name="customer" id="customer" class="input-box">
										<?php
											foreach ($customers as $customer) {
                                                $selected = $customer['id'] === $reservation['idCustomer'] ? 'selected' : '';
												echo "<option value='{$customer['id']}' {$selected} >{$customer['customerName']} {$customer['customerSurname']}</option>";
											}
										?>
									</select>
								</div>

								<div class="input-container">
									<label for="bungalow">Select bungalow</label>
									<select name="bungalow" id="bungalow" class="input-box">
										<?php
											foreach ($bungalows as $bungalow) {
                                                $selected = $bungalow['id'] === $reservation['idBungalow'] ? 'selected' : '';
												echo "<option value='{$bungalow['id']}' {$selected}>{$bungalow['name']}</option>";
											}
										?>
									</select>
								</div>

								<div class="form-box d-flex justify-content-between row">
                                    <div class="input-container col-6 ps-0">
                                        <label for="checkIn">Check in date</label>
                                        <?php
                                            $checkIn = date('Y-m-d', strtotime($reservation['checkIn']));
                                        ?>
                                        <input type="date" name="checkIn" id="checkIn" class="input-box" value="<?php echo htmlspecialchars($checkIn);?>" />
                                    </div>

                                    <div class="input-container col-6 pe-0">
                                        <label for="checkOut">Check out date</label>
                                        <?php
                                            $checkOut = date('Y-m-d', strtotime($reservation['checkOut']));
                                        ?>
                                        <input type="date" name="checkOut" id="checkOut" class="input-box" value="<?php echo htmlspecialchars($checkOut); ?>" />
                                    </div>
                                </div>

								<div class="input-container">
									<label for="paymentMethod">Select payment method</label>
									<select name="paymentMethod" id="paymentMethod" class="input-box">
										<?php
										foreach ($paymentMethods as $paymentMethod) {
                                            $selected = $paymentMethod['id'] === $reservation['paymentMethodId'] ? 'selected' : '';
											echo "<option value='{$paymentMethod['id']}' {$selected}>{$paymentMethod['name']}</option>";
										}
										?>
									</select>
								</div>

							<div class="input-container">
								<label for="notes">Notes</label>
								<textarea name="notes" id="notes" class="input-box">
                                    <?php echo $reservation['notes']; ?>
                                </textarea>
							</div>

							<div class="form-box d-flex gap-5">

								<div class="input-container input-container--checkbox">
									<label for="earlyCheckIn">Early check in request</label>
                                    <?php
                                        $checked = $reservation['earlyCheckInRequest'] ? 'checked' : '';
                                    ?>
									<input type="checkbox" name="earlyCheckIn" id="earlyCheckIn" class="input-box" <?php echo $checked ?> />
								</div>
								
								<div class="input-container input-container--checkbox">
									<label for="lateCheckOut">Late check out request</label>
                                    <?php
                                        $checked = $reservation['lateCheckOutRequest'] ? 'checked' : '';
                                    ?>
									<input type="checkbox" name="lateCheckOut" id="lateCheckOut" class="input-box" <?php echo $checked ?> />
								</div>
							</div>

							<button class="button col-2 align-self-end">Edit</button>
						</form>
						</section>
					</main>
				</div>
			</div>
		</div>

		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
			crossorigin="anonymous"></script>
	</body>
</html>
