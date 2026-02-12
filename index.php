<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Evergreen Bungalows</title>
		<link rel="shortcut icon" type="image/png" href="assets/images/logo.png" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;700&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="css/main.css" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
			crossorigin="anonymous" />
	</head>
	<?php
		session_start();

		$errors = $_SESSION['errors'] ?? [];
		$formData = $_SESSION['formData'] ?? [];

		unset($_SESSION['errors'], $_SESSION['formData']);
	?>

	<body>
		<div class="wrapper">
			<div class="row">
				<div class="col-12">
					<main class="main">

						
						<section class="section section__login mt-5">
							<div class="heading d-flex justify-content-between mb-5">
								<h1>Login</h1>
							</div>
						</section>
						
						<section class="section section__form">
							<form action="./php/login/logIn.php" method="post" class="form w-50">
								<div class="input-container">
									<label for="login">Login:</label>
									<input
										type="text"
										name="login"
										id="login"
										class="input-box"
										placeholder="Enter your login"
										required 
										value="<?php echo $formData['login'] ?? '' ?>"
									/>

									<?php
											if (isset($errors['login'])) {
												echo "<p style='color: #FF4D4D'>{$errors['login']}</p>";
											}
										?>
								</div>

								<div class="input-container">
									<label for="password">Password:</label>
									<input
										type="password"
										name="password"
										id="password"
										class="input-box"
										placeholder="Enter your password"
										required 
										value="<?php echo $formData['password'] ?? '' ?>"
									/>

									<?php
										if (isset($errors['password'])) {
											echo "<p style='color: #FF4D4D'>{$errors['password']}</p>";
										}
									?>

								</div>


								<div class="d-flex justify-content-end">
									<button type="submit" class="button col-2 align-self-end">Login</button>
								</div>
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
