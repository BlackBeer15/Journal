<?php 
	include_once('php/dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stud Journal</title>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="images/favikon.ico" type="image/x-icon"/>	
	<link rel="stylesheet" type="text/css" href="styles/style.css"/>
	<link rel="stylesheet" type="text/css" href="styles/header.css"/>
	<link rel="stylesheet" type="text/css" href="styles/mainstud.css"/>
	<link rel="stylesheet" type="text/css" href="styles/media/mediastud.css"/>
	<script src="https://kit.fontawesome.com/8b77c9bfea.js"></script>
</head>
<body>
	<header>
		<hr/>
		<div class="headblc">
			<a href="index.php" title="Назад">
				<i class="fas fa-arrow-left"></i>
			</a>
			<p>Журнал студента</p>
			<div class="headline"></div>
		</div>
	</header>
	<main>
		<?php 
			$student = mysqli_query($connect, "SELECT `fio` FROM `student` WHERE `idStudent` = 1");
		?>
		<input class="fio-stud" readonly="" <?php 
			while($row = $student->fetch_assoc()) {
				echo 'value="'.$row['fio'].'"';
			}
		?> />
		<div class="table">
			<div class="head-table">
				<div class="subj">Дисциплина</div>
				<div class="rate">Оценка</div>
				<div class="date">Дата</div>
			</div>
			<div class="main-table">
				<div class="coloumn-sub">
					<?php 
						$subj =  mysqli_query($connect, "SELECT `namesub` FROM `rate` LEFT JOIN `subject` ON `subject` = `idSubject` WHERE `student` = 1");
						foreach ($subj as $row) {
							echo '
								<div class="tsub">
									'.$row['namesub'].'
								</div>
							';
						}
					?>
				</div>
				<div class="coloumn-rate">
					<?php 
						$rate =  mysqli_query($connect, "SELECT `rate` FROM `rate` LEFT JOIN `subject` ON `subject` = `idSubject` WHERE `student` = 1");
						foreach ($rate as $row) {
							echo '
								<div class="trate">
									'.$row['rate'].'
								</div>
							';
						}
					?>
				</div>
				<div class="coloumn-date">
					<?php 
						$date =  mysqli_query($connect, "SELECT `date` FROM `rate` LEFT JOIN `subject` ON `subject` = `idSubject` WHERE `student` = 1");
						foreach ($date as $row) {
							echo '
								<div class="trate">
									'.$row['date'].'
								</div>
							';
						}
					?>
				</div>
			</div>
		</div>
	</main>
</body>
</html>