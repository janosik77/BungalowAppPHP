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

        if(!isset($_SESSION['employee'])){
            header("Location: ../../index.php");
            exit;
        }

        if(isset($_SESSION['employee'])){
            $employee = $_SESSION['employee'];
        }
        
		require_once "../../php/bungalows/bungalowsFunc.php";

        $id = $_GET['id'];
		$selectedBungalow = getBungalowById($id);
        $bungalowReservations = getBungalowReservations($id);
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
						<a class="nav-link" aria-current="page" href="../reservations/reservations.php">Reservations</a>
						<a class="nav-link active" href="#">Bungalows</a>
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
                    <header class="header">
							<div class="user">
								<div class="user__img">
									<img src="<?php echo "../../".$employee['imagePath'] ?>" alt="user image" />
									<div class="user__status user__status--active"></div>
								</div>
								<div class="user__data">
									<h4 class="user__name">
										<?php echo $employee['employeeName'] . " " . $employee['employeeSurname'] ?>
									</h4>
									<p class="user__email">
										<?php echo $employee['employeeEmail'] ?>
									</p>
								</div>
							</div>

							<div class="action-btns d-flex">
								<button class="btn">
									<img src="../../assets/icons/msg.svg" alt="" />
								</button>
								<button class="btn">
									<img src="../../assets/icons/notification.svg" alt="" />
								</button>
								<a href="../../php/logout/logOutloyee.php" class="btn">
									<img src="../../assets/icons/logout.svg" alt="" />
								</a>
							</div>
						</header>

                        <section class="item-section section mt-5">
                            <a class="go-back" href="bungalows.php">
                                <img src="../../assets/icons/arrow-left.svg" alt="Go back" />
                            </a>

                            <div class="heading section-margin">
                                <h1 class="mt-4">Bungalow</h1>
                            </div>

                            <div class="item-section__overview section-box section-margin flex-md-row">
                                <div class="item-img col-12 col-md-5 col-lg-4">
                                    <img src="<?php echo "../../".$selectedBungalow['bungalowPath'] ?>" alt="" />
                                </div>
                                <div class="item-section__info col-12 col-md-7 d-flex flex-column justify-content-between">
                                    <h3 class="item-section__title">
                                        <?php echo $selectedBungalow['name'] ?>
                                    </h3>
                                    <div class="item-section__boxes flex-lg-row gap-lg-5 justify-content-lg-between flex-wrap flex-xxl-nowrap">
                                        <div class="overview-card col-9 col-sm-7 col-md-8 col-lg-5 col-xxl-4 mt-3">
                                            <div class="overview-card__stats">
                                                <div class="overview-card__stats--box">
                                                    <p class="overview-card__stats--title">Capacity</p>
                                                    <p class="overview-card__stats--number">
                                                        <?php echo $selectedBungalow['capacity'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overview-card col-9 col-sm-7 col-md-8 col-lg-5 col-xxl-4 mt-3">
                                            <div class="overview-card__stats">
                                                <div class="overview-card__stats--box">
                                                    <p class="overview-card__stats--title">Price per night</p>
                                                    <p class="overview-card__stats--number">
                                                        <?php echo $selectedBungalow['pricePerNight']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item-section__actions mt-3">

                                        <form class="d-flex align-items-center justify-content-center" method="get">
                                            <input type="hidden" name="id" value="<?php echo $selectedBungalow['id']; ?>" />
                                                <a href="editBungalow.php?id=<?php echo $selectedBungalow['id']; ?>">
                                                    <img src="../../assets/icons/edit.svg" alt="" />
                                                </a>
                                        </form>

                                        <form class="d-flex align-items-center justify-content-center" action="../../php/bungalows/deletebungalow.php" method="post">
                                            <input type="hidden" name="deleteBungalow" value="<?php echo $selectedBungalow["id"]; ?>" />
                                            <button class="svg-button" href="">
                                                <img src="../../assets/icons/delete.svg" alt="Delete icon" />
                                                </button>
                                        </form>
                                    </div>
                                </div>
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
	</body>
</html>
