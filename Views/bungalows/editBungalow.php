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
		require_once "../../php/bungalows/bungalowsFunc.php";

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $bungalow = getBungalowById($id);
            $bungalowName = $bungalow['name'];
            $bungalowCapacity = $bungalow['capacity'];
            $bungalowPricePerNight = $bungalow['pricePerNight'];
            $bungalowImage = $bungalow['bungalowPath'];
            if(!$bungalow){
                exit("Bungalow not found");
                $bungalowName = "";
                $bungalowCapacity = "";
                $bungalowPricePerNight = "";
                $bungalowImage = "";
            }
        } else {
            exit("No bungalow id provided");
        }
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
						<a class="nav-link active" href="../bungalows/bungalows.php">Bungalows</a>
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
								<h1>Edit bungalow</h1>
							</div>
						</section>

						<section class="section section__form">
							<form action="../../php/bungalows/updateBungalow.php" method="post" class="form" enctype="multipart/form-data">
								<input type="hidden" name="id" value="<?php echo $id ?>" />
								<input type="hidden" name="currentImage" value="<?php echo $bungalowImage ?>" />

								<div class="input-container">
									<label for="name">Bungalow name</label>
									<input type="text" name="name" id="name" class="input-box" value="<?php echo $bungalowName ?>" />
								</div>

								<div class="input-container">
									<label for="capacity">Bungalow capacity</label>
									<input type="number" name="capacity" id="capacity" class="input-box" value="<?php echo $bungalowCapacity ?>" />
								</div>

                                <div class="input-container">
                                    <label for="pricePerNight">Price per night</label>
                                    <input type="number" step=".1" name="pricePerNight" id="pricePerNight" class="input-box" value="<?php echo $bungalowPricePerNight ?>"></input>
                                </div>

							<div class="input-container input-container--checkbox">
								<label for="image">Image</label>
								<input type="file" lang="en" name="image" id="image" class="input-box" />
							</div>

							<div class="input-container input-container--checkbox">
								<?php if (!empty($bungalowImage)): ?>
									<p>Current Image: <strong><?php echo str_replace('assets/images/', '', $bungalowImage); ?></strong></p>
									<img src="<?php echo htmlspecialchars("../../".$bungalowImage); ?>" alt="Current Image" width="100" />
								<?php endif; ?>
							</div>
                            <button class="button col-2 align-self-end" type="submit" name="submit">Edit</button>
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
