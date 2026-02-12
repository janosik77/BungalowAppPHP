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
        require_once "../../php/discounts/discountFunctions.php";

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $discount = getDiscountById($id);
            $bungalow = $discount['bungalowName'];
            $validFrom = $discount['validFrom'];
            $validTo = $discount['validTo'];
            $promoName = $discount['name'];
            $amount = $discount['discount'];
            $description = $discount['description'];
        } else {
            $bungalow = "";
            $validFrom = "";
            $validTo = "";
            $promoName = "";
            $discount = "";
            $description = "";
            exit("No discount id provided");
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
				<a class="navbar-brand d-flex align-items-center" href="../../index.php">
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
						<a class="nav-link" href="../../index.php">Home</a>
						<a class="nav-link" href="../reservations/reservations.php">Reservations</a>
						<a class="nav-link" href="../bungalows/bungalows.php">Bungalows</a>
						<a class="nav-link" href="../employees/employees.php">Employees</a>
						<a class="nav-link" href="../customers/customers.php">Customers</a>
						<a class="nav-link active" href="../discounts/discounts.php">Discounts</a>
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
								<h1>Edit Discount</h1>
							</div>
						</section>

						<section class="section section__form">
							<form action="../../php/discounts/updateDisciunt.php" method="post" class="form">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />

                            <div class="input-container">
									<label for="bungalow">Select bungalow</label>
									<select name="bungalow" id="bungalow" class="input-box">
										<?php
										foreach ($bungalows as $bungalow) {
                                            $selected = $bungalow['id'] == $discount['idBungalow'] ? "selected" : "";
											echo "<option value='{$bungalow['id']}' {$selected}>{$bungalow['name']}</option>";
										}
										?>
									</select>
							</div>

                            <div class="form-box d-flex justify-content-between row">
                                <div class="input-container col-6 ps-0">
                                    <label for="validFrom">Valid from</label>
                                    <?php
                                            $promoValidFrom = date('Y-m-d', strtotime($validFrom));
                                        ?>
                                    <input type="date" name="validFrom" id="validFrom" class="input-box" value="<?php echo htmlspecialchars($promoValidFrom) ?>" />
                                </div>

                                <div class="input-container col-6 pe-0">
                                    <label for="validTo">Valid to</label>
                                    <?php
                                            $promoValidTo = date('Y-m-d', strtotime($validTo));
                                        ?>
                                    <input type="date" name="validTo" id="validTo" class="input-box" value="<?php echo htmlspecialchars($promoValidTo) ?>" />
                                </div>
                            </div>

                            <div class="input-container">
                                    <label for="promoName">Discount name</label>
                                    <input type="text" name="promoName" id="promoName" class="input-box" value="<?php echo $promoName ?>" />
                            </div>

                            <div class="input-container">
                                    <label for="discount">Discount</label>
                                    <input type="number" name="discount" id="discount" class="input-box" placeholder="in %"value="<?php echo $discount ?>" />
                            </div>

                            <div class="input-container">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" id="description" class="input-box" value="<?php echo $description ?>" />
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
