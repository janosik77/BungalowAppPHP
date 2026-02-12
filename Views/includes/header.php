                        <?php 
							
							if(!isset($_SESSION['employee'])){
								header("Location: ../../index.php");
								exit;
							}
					
							if(isset($_SESSION['employee'])){
								$employee = $_SESSION['employee'];
							}
						?> 
						
						<header class="header">
							<div class="user">
								<div class="user__img">
									<img src="<?php echo  "../../" .$employee['imagePath']  ?>" alt="user image" />
									<div class="user__status user__status--active"></div>
								</div>
								<div class="user__data">
									<h4 class="user__name"><?php echo $employee['employeeName'] . " " . $employee['employeeSurname'] ?></h4>
									<p class="user__email"><?php echo $employee['employeeEmail'] ?></p>
								</div>
							</div>

							<div class="action-btns d-flex">
								<a class="btn">
									<img src="../../assets/icons/msg.svg" alt="" />
								</a>
								<a class="btn">
									<img src="../../assets/icons/notification.svg" alt="" />
								</a>
								<a href="../../php/logoout/logOut.php" class="btn">
									<img src="../../assets/icons/logout.svg" alt="" />
								</a>
							</div>
						</header>