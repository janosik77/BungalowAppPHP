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
		require_once "../../php/reservations/reservationFunc.php";
		require_once "../../php/bungalows/bungalowsFunc.php";
		require_once "../../php/customers/customerFunc.php";
		require_once "../../php/paymentMethodFunc.php";
        require_once "../../php/employeeRoleFunc.php";

		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$customer = getCustomerById($id);
			$customerName = $customer['customerName'];
			$customerSurname = $customer['customerSurname'];
			$customerEmail = $customer['customerEmail'];
			$customerPhoneNumber = $customer['customerPhoneNumber'];
			$customerStreet = $customer['customerStreet'];
			$customerStreetNumber = $customer['customerStreetNumber'];
			$customerHouseNumber = $customer['customerHouseNumber'];
			$customerCity = $customer['customerCity'];
			$customerCountry = $customer['customerCountry'];
			$customerPostalCode = $customer['customerPostalCode'];
			$customerNationality = $customer['nationality'];
		} else {
			$customerName = "";
			$customerSurname = "";
			$customerEmail = "";
			$customerPhoneNumber = "";
			$customerStreet = "";
			$customerStreetNumber = "";
			$customerHouseNumber = "";
			$customerCity = "";
			$customerCountry = "";
			$customerPostalCode = "";
			$customerNationality = "";
			exit("No customer id provided");
		}

		$reservations = getReservationsForTable();
		$bungalows = getAllBungalows();
		$customers = getCustomersForTable();
		$paymentMethods = getAllPaymentMethods();
        $employeeRoles = getAllEmployeeRoles();
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
						<a class="nav-link" href="../reservations/reservations.php">Reservations</a>
						<a class="nav-link" href="../bungalows/bungalows.php">Bungalows</a>
						<a class="nav-link" href="../employees/employees.php">Employees</a>
						<a class="nav-link active" href="../customers/customers.php">Customers</a>
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
							require "../includes/header.php"
						?>

						<section class="section section__reservations mt-5">
							<div class="heading d-flex justify-content-between mb-5">
								<h1>Edit Customer</h1>
							</div>
						</section>

						<section class="section section__form">
							<form action="../../php/customers/updateCustomer.php" method="post" class="form">
								<input type="hidden" name="id" value="<?php echo $id ?>" />

								<div class="form-box d-flex justify-content-between row">
                                    <div class="input-container col-6 ps-0">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="input-box" value="<?php echo $customerName ?>" />
                                    </div>

                                    <div class="input-container col-6 pe-0">
									    <label for="surname">Surname</label>
									    <input type="text" name="surname" id="surname" class="input-box" value="<?php echo $customerSurname ?>" />
								    </div>
                                </div>

								<div class="input-container">
									<label for="email">Email address</label>
									<input type="email" name="email" id="email" class="input-box" value="<?php echo $customerEmail ?>" />
								</div>

								<div class="input-container">
									<label for="phoneNumber">Phone number</label>
									<input type="text" name="phoneNumber" id="phoneNumber" class="input-box" value="<?php echo $customerPhoneNumber ?>" />
								</div>

								<div class="input-container">
									<label for="street">Street</label>
									<input type="text" name="street" id="street" class="input-box" value="<?php echo $customerStreet ?>" />
								</div>

                                <div class="form-box d-flex justify-content-between row">
                                    <div class="input-container col-6 ps-0">
                                        <label for="streetNumber">Street number</label>
                                        <input type="text" name="streetNumber" id="streetNumber" class="input-box" value="<?php echo $customerStreetNumber ?>" />
                                    </div>

                                    <div class="input-container col-6 pe-0">
									    <label for="houseNumber">House number</label>
									    <input type="text" name="houseNumber" id="houseNumber" class="input-box"  value="<?php echo $customerHouseNumber ?>" />
								    </div>
                                </div>

                                <div class="input-container">
									<label for="city">City</label>
									<input type="text" name="city" id="city" class="input-box" value="<?php echo $customerCity ?>" />
								</div>

                                <div class="form-box d-flex justify-content-between row">
                                    <div class="input-container col-6 ps-0">
                                        <label for="country">Country</label>
                                        <input type="text" name="country" id="country" class="input-box" value="<?php echo $customerCountry ?>" />
                                    </div>

                                    <div class="input-container col-6 pe-0">
									    <label for="postalCode">Postal code</label>
									    <input type="text" name="postalCode" id="postalCode" class="input-box" value="<?php echo $customerPostalCode ?>" />
								    </div>
                                </div>

                                <div class="input-container">
									<label for="nationality">Nationality</label>
									<input type="text" name="nationality" id="nationality" class="input-box" value="<?php echo $customerNationality ?>" />
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
