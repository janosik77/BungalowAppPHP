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
		session_start();

		require_once "../../php/reservations/reservationFunc.php";

		if(isset($_POST['search'])){
			$searchQuery = $_POST['search'];
			$reservations = searchReservations($searchQuery);
		}
		else if(isset($_POST['sort']) && $_POST['sort'] !== 'all'){
			$sortQuery = $_POST['sort'];
			$reservations = sortReservations($sortQuery);
		} else if(isset($_POST['sort']) && $_POST['sort'] === 'all'){
			$reservations = getReservationsForTable();
		}
		else{
			$reservations = getReservationsForTable();
		}

		$sortQuery = $_POST['sort'] ?? "all";
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
						<a class="nav-link active" aria-current="page" href="#">Reservations</a>
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
							require "../includes/header.php"
						?>

						<section class="section section__reservations mt-5">
							<div class="heading d-flex justify-content-between mb-5">
								<h1>Reservations</h1>
								<a href="addReservation.php" class="button">Add reservation</a>
							</div>
						</section>

						<section class="section section__reservations-table mt-5">

						<div class="table-actions mb-5">
							<form method="post" class="table-actions__search">
									<input type="text" name="search" class="input-box" placeholder="Search" value="<?php echo $_POST["search"]  ?? "" ?>" />
									<button class="button">Search</button>
							</form>
								<form method="post" class="table-actions__sort">
									<select name="sort" id="sort" class="input-box">
										<option value="all" <?php echo $sortQuery === 'all' ? 'selected' : '' ?>>All</option>
										<option value="name" <?php echo $sortQuery === 'name' ? 'selected' : '' ?>>Bungalow name</option>
										<option value="checkIn" <?php echo $sortQuery === 'checkIn' ? 'selected' : '' ?>>Check in</option>
										<option value="checkOut" <?php echo $sortQuery === 'checkOut' ? 'selected' : '' ?>>Check out</option>
										<option value="amount" <?php echo $sortQuery === 'amount' ? 'selected' : '' ?>>Amount</option>
										<option value="reservationStatus" <?php echo $sortQuery === 'reservationStatus' ? 'selected' : '' ?>>Status</option>
									</select>
									<button class="button">Sort</button>
								</form>
							</div>

							<table class="table reservations-table">
								<thead>
									<tr>
										<th scope="col">Bungalow</th>
										<th scope="col">Guest</th>
										<th scope="col">Dates</th>
										<th scope="col">Amount</th>
										<th scope="col">Status</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($reservations as $key=>$reservation){?>
										<tr>
										<td>
											<div class="reservations-table__bungalow">
												<?php echo $reservation['bungalowName']; ?>
											</div>
										</td>
										<td>
											<div class="reservations-table__guest">
												<span class="name">
													<?php echo $reservation['userName'] . " " . $reservation['userSurname']; ?>
												</span>
												<span class="email">
													<?php echo $reservation['userEmail']; ?>
												</span>
											</div>
										</td>
										<td>
											<div class="reservations-table__dates">
												<?php 
													        $checkInDate = date('Y-m-d', strtotime($reservation['checkIn']));
															$checkOutDate = date('Y-m-d', strtotime($reservation['checkOut']));
													
															echo $checkInDate . " - " . $checkOutDate;
												?>
											</div>
										</td>
										<td>
											<div class="reservations-table__amount">$
												<?php echo $reservation['amount']; ?>
											</div>
										</td>
										<td>
										<div class="status <?php echo 'status__' . $reservation['reservationStatus']; ?>">
												<?php echo $reservation['reservationStatus']; ?>
											</div>
										</td>

										<td>
											<div class="reservations-table__actions">
												<form class="d-flex align-items-center justify-content-center" method="get">
													<input type="hidden" name="id" value="<?php echo $reservation['id']; ?>" />
													<a href="editReservation.php?id=<?php echo $reservation['id']; ?>
													">
														<img src="../../assets/icons/edit.svg" alt="" />
													</a>
												</form>

												<form class="d-flex align-items-center justify-content-center" method="get">
													<input type="hidden" name="id" value="<?php echo $reservation['id']; ?>" />
													<a href="reservationItem.php?id=<?php echo $reservation['id']; ?>">
														<img src="../../assets/icons/view.svg" alt="" />
													</a>
												</form>

												<form class="d-flex align-items-center justify-content-center" action="../../php/reservations/delReservation.php" method="post">
														<input type="hidden" name="delReservation" value="<?php echo $reservation["id"]; ?>" />
														<button class="svg-button" href="">
														<img src="../../assets/icons/delete.svg" alt="Delete icon" />
														</button>
												</form>
											</div>
										</td>
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
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
