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
		require_once "../../php/discounts/discountFunctions.php";
		require_once "../../php/bungalows/bungalowsFunc.php";

		if(isset($_POST['search'])){
			$searchQuery = $_POST['search'];
			$discounts = searchDiscounts($searchQuery);
		}
		else if(isset($_POST['sort']) && $_POST['sort'] !== 'all'){
			$sortQuery = $_POST['sort'];
			$discounts = sortDiscounts($sortQuery);
		} else if(isset($_POST['sort']) && $_POST['sort'] === 'all'){
			$discounts = getDiscountsForTable();
			$bungalows = getAllBungalows();
		}
		else{
			$discounts = getDiscountsForTable();
			$bungalows = getAllBungalows();
		}

		$sortQuery = $_POST['sort'] ?? "all";
	?>

	<body>
		<nav class="navbar navbar-expand-lg">
			<div class="wrapper d-flex justify-content-between container-fluid">
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
						<a class="nav-link" href="../customers/customers.php">Customers</a>
						<a class="nav-link active" aria-current="page" href="#">Discounts</a>
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
								<h1>Discounts</h1>
								<a href="addDiscount.php" class="button">Add discount</a>
							</div>
						</section>

						<section class="section section__customers-table mt-5">

							<div class="table-actions mb-5">
								<form method="post" class="table-actions__search">
									<input name="search" type="text" class="input-box" placeholder="Search" value="<?php echo $_POST['search'] ?? '' ?>" />
									<button class="button">Search</button>
								</form>
								<form method="post" class="table-actions__sort">
									<select name="sort" id="sort" class="input-box">
										<option value="all"<?php echo $sortQuery === 'all' ? 'selected' : '' ?>>All</option>
										<option value="name"<?php echo $sortQuery === 'name' ? 'selected' : '' ?>>Name</option>
										<option value="validPeriod"<?php echo $sortQuery === 'validPeriod' ? 'selected' : '' ?>>Valid period</option>
										<option value="discount"<?php echo $sortQuery === 'discount' ? 'selected' : '' ?>>Discount</option>
										<option value="description"<?php echo $sortQuery === 'description' ? 'selected' : '' ?>>Description</option>
										<option value="bungalowName"<?php echo $sortQuery === 'bungalowName' ? 'selected' : '' ?>>Bungalow</option>
									</select>
									<button class="button">Sort</button>
								</form>
							</div>
							<table class="table reservations-table promo-table">
								<thead>
									<tr>
										<th scope="col">Name</th>
										<th scope="col">Valid period</th>
										<th scope="col">Description</th>
										<th scope="col">Bungalows</th>
										<th scope="col">Discount</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($discounts as $key=>$discount){
									?>

									<tr>
										<td>
											<div class="promo-table__name">
												<?php echo $discount["name"]; ?>
											</div>
										</td>
										<td>
											<div class="promo-table__valid-period">
												<?php 
													$validFrom = date('Y-m-d', strtotime($discount["validFrom"]));
													$validTo = date('Y-m-d', strtotime($discount["validTo"]));
													echo $validFrom . " - " . $validTo;
												?>
											</div>
										</td>
										<td>
											<div class="promo-table__description">
												<?php echo $discount["description"]; ?>
											</div>
										</td>
										<td>
											<div class="promo-table__bungalows">
												<?php echo $discount["bungalowName"]; ?>
											</div>
										</td>
										<td>
											<div class="promo-table__discount">
												<?php echo $discount["discount"]; ?>
												%
											</div>
										</td>
										<td>
											<div class="reservations-table__actions">
												<form class="d-flex align-items-center justify-content-center" method="get">
														<input type="hidden" name="id" value="<?php echo $discount['id']; ?>" />
														<a href="editDiscount.php?id=<?php echo $discount['id']; ?>">
															<img src="../../assets/icons/edit.svg" alt="" />
														</a>
												</form>

												<form class="d-flex align-items-center justify-content-center" method="get">
														<input type="hidden" name="id" value="<?php echo $discount['id']; ?>" />
														<a href="discountItem.php?id=<?php echo $discount['id']; ?>">
															<img src="../../assets/icons/view.svg" alt="View icon" />
														</a>
												</form>


												<form class="d-flex align-items-center justify-content-center" action="../../php/discounts/deleteDiscount.php" method="post">
													<input type="hidden" name="deleteDiscount" value="<?php echo $discount["id"]; ?>" />
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
