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
        <link rel="stylesheet" type="text/css" href="../../slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="../../slick/slick-theme.css" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
			crossorigin="anonymous" />
	</head>

	<?php
		session_start();

		if (isset($_COOKIE['visitsCount'])) {
			// If cookie exists, increment its value
			$visitsCount = $_COOKIE['visitsCount'];
			$visitsCount++;
		} else {
			// If cookie does not exist, initialize it to 1 (first visit)
			$visitsCount = 1;
		}
		
		// Set the cookie to last for 1 year
		setcookie('visitsCount', $visitsCount, time() + 60*60*24*365, '/'); // Cookie v

		if(!isset($_SESSION['employee'])){
			header("Location: ../../index.php");
			exit;
		}
		if(isset($_SESSION['employee'])){
			$employee = $_SESSION['employee'];
		}

		require "../../php/homeFunc.php";

		$reservations = getAllReservations();
		$bungalows = getAllBungalows();
	?>
	<body>
		<nav class="navbar navbar-expand-lg">
			<div class="wrapper d-flex justify-content-between container-fluid">
				<a class="navbar-brand d-flex align-items-center" href="home.php">
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
						<a class="nav-link active" aria-current="page" href="#">Home</a>
						<a class="nav-link" href="../reservations/reservations.php">Reservations</a>
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
	
						<section class="section section mt-5">
							<div class="heading mb-5">
								<h1>Dashboard</h1>
								<p>Welcome back, <?php echo $employee['employeeName']?></p>
							</div>
	
							<div class="overview section-box mb-5">
								<div class="overview-top d-flex justify-content-between">
									<p class="overview-title col-6">Overview from last 30 days</p>
								</div>
	
								<div class="overview-content d-flex justify-content-between col-12">
									<div class="overview-card col-sm-3 col-xxl-2 mt-3">
										<div class="overview-card__icon-box overview-card__icon-box--reservations">
											<img src="../../assets/icons/reservations.svg" alt="" />
										</div>
	
										<div class="overview-card__stats">
											<div class="overview-card__stats--box overview-card__stats--box-reservations">
												<div class="overview-card__stats--title">reservations</div>
												<div class="overview-card__stats--number">
													<?php
														echo calcReservations();
													?>
												</div>
											</div>
										</div>
	
									</div>
	
									<div class="overview-card col-sm-3 col-xxl-2 mt-3">
										<div class="overview-card__icon-box overview-card__icon-box--checkins">
											<img src="../../assets/icons/checkins.svg" alt="" />
										</div>
	
										<div class="overview-card__stats">
											<div class="overview-card__stats--box overview-card__stats--box-checkins">
												<div class="overview-card__stats--title">Check ins</div>
												<div class="overview-card__stats--number">
													<?php
														echo calcCheckIns();
													?>
												</div>
											</div>
										</div>
									</div>
	
									<div class="overview-card col-sm-3 col-xxl-2 mt-3">
										<div class="overview-card__icon-box overview-card__icon-box--occupancy">
											<img src="../../assets/icons/occupancy-rate.svg" alt="" />
										</div>

										<div class="overview-card__stats">
											<div class="overview-card__stats--box overview-card__stats--box-occupancy">
												<div class="overview-card__stats--title">occupancy</div>
												<div class="overview-card__stats--number">
													<?php echo calcOccupancyRate(); ?>
													%
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<section class="section mt-5 heading">
							<h2>Visit count:</h2>
							<p class="visit-count">
								<?php echo $visitsCount; ?>
						</section>

						<section class="section section__popular-bungalows mt-5">
							<div class="heading mb-5">
								<h2>Bungalows</h2>
								<p>Discover our bungalows</p>
							</div>
	
							<div class="popular-bungalows">
	
							</div>
						</section>
					</main>
				</div>
			</div>
		</div>

		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
			crossorigin="anonymous"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="../../slick/slick.min.js"></script>
        <script src="../../js/slick.js"></script>

	</body>
</html>
