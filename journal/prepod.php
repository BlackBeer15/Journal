<?php 
	include_once('php/dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Prepod Journal</title>
	<meta charset="utf-8"/>
	<link rel="shortcut icon" href="images/favikon.ico" type="image/x-icon"/>	
	<link rel="stylesheet" type="text/css" href="styles/style.css"/>
	<link rel="stylesheet" type="text/css" href="styles/header.css"/>
	<link rel="stylesheet" type="text/css" href="styles/mainprep.css"/>
	<link rel="stylesheet" type="text/css" href="styles/media/mediaprepod.css"/>
	<script src="https://kit.fontawesome.com/8b77c9bfea.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
	<header>
		<hr/>
		<div class="headblc">
			<a href="index.php" title="Назад">
				<i class="fas fa-arrow-left"></i>
			</a>
			<p>Журнал преподавателя</p>
			<div class="headline"></div>
		</div>
	</header>
	<main>
		<form class="tabel-query" method="POST">
			<div class="inp-blc">
				<div>
					Группа: <input name="group" list="groups" />
					<datalist id="groups">
						<?php 
							$groups = mysqli_query($connect, "SELECT * FROM `group`");
							foreach ($groups as $row) {
								echo '<option value="'.$row['namegro'].'">';
							}
						?>
					</datalist>
				</div>
				<div>
					Дисциплина: <input name="subject" list="subjects" />
					<datalist id="subjects">
						<?php 
							$subjects = mysqli_query($connect, "SELECT * FROM `subject`");
							foreach ($subjects as $row) {
								echo '<option value="'.$row['namesub'].'">';
							}
						?>
					</datalist>
				</div>
			</div>
			<button type="submit" name="Tquer">Открыть</button>
		</form>
		<form class="table-journal" method="POST" id="myTable">
			<?php
				$group = '';
				$subject = ''; 
				if (isset($_POST['Tquer'])) {
					$group = $_POST['group'];
					$subject = $_POST['subject'];
				}
			?>
			<input class="par-gr" <?php echo 'value="'.$group.'"';?> readonly="" name="parGr" /> <br />
			<input class="par-sub" <?php echo 'value="'.$subject.'"';?> readonly="" name="parSub" />
			<div class="table">
				<div class="first-row-table">
					<div class="fio-head">Студент</div>
					<div class="all-rate-head">Все оценки 1/2 семестра</div>
					<div class="middle-rate-head">Средний бал</div>
				</div>
				<div class="content-table">
					<div class="fio">
						<div class="bl1"></div>
						<?php
							if (isset($_POST['Tquer'])) {
								$students = mysqli_query($connect, "SELECT `fio` from `student` left join `group` on `idGroup` = `group` where `namegro`='".$group."' ORDER By `fio`");
								foreach ($students as $row) {
									echo '
										<div class="table-student">
											'.$row['fio'].'
										</div>
									';
								}
							}
						?>
					</div>
					<div class="all-rate">
						<div class="row-date">
							<?php
								$i = 0;
								$j = 0;

								$array = array(
									array(),
								);
								if (isset($_POST['Tquer'])) {
									$date = mysqli_query($connect, "SELECT DISTINCT `date` from `rate` ORDER BY `date` ASC");
									foreach ($date as $row) {
										echo '
											<div class="date">
												'.$row['date'].'
											</div>
										';

									}
								}
							?>							
						</div>
						<div class="container-rate">
							<?php
								if (isset($_POST['Tquer'])) {
									$date = mysqli_query($connect, "SELECT DISTINCT `date` from `rate` ORDER BY `date` ASC");
									foreach ($date as $row) {
										echo '
											<div class="coloumn-rate">';
												$students = mysqli_query($connect, "SELECT `idstudent` from `student` left join `group` on `idGroup` = `group` where `namegro`='".$group."' ORDER By `fio`");
												foreach ($students as $row1) {	
													echo '
														<div class="rate">
															<input class="in-rate" name="'.$j.'.'.$i.'" value="';
															$mark = mysqli_query($connect, "SELECT `rate` FROM `rate` LEFT JOIN `subject` on `idSubject` = `subject` WHERE `student` = ".$row1['idstudent']." and `date` = '".$row['date']."' AND `namesub` = '".$subject."'");
															foreach ($mark as $row2) {
																echo $row2['rate'];
																$array[$i][$j] = $row2['rate'];
															}
															echo '"/>';
													echo '		
														</div>
													';
													$i++;
												}
										echo '
											</div>';
										$j++;
										$i = 0;
									}
								}
							?>
						</div>
					</div>
					<div class="middle-rate">
						<div class="bl2"></div>
						<div class="table-middle-rate">
							0.000
						</div>
					</div>
				</div>
			</div>
			<div class="buttons">
				<button type="submit" name="updbtn" onclick="upd()">Изменить</button>
				<button type="submit" name="newbtn" onclick="ins()">Создать</button>
			</div>
		</form>
		<p class="ved">Сформировать ведомость</p>
		<div class="line">
			<hr>
			<div class="cube"></div>
		</div>
		<ul>
			<li><a href="#" onclick="createzv()">3В</a></li>
			<li><a href="#" onclick="createzvp()">3ВП</a></li>
			<li><a href="#" onclick="createprot()">Протокол ИГА</a></li>
			<li><a href="#" onclick="createev()">ЭВ</a></li>
			<li><a href="#" onclick="createtb()">ПОсА</a></li>
		</ul>
	</main>
	<script type="text/javascript" src="js/upd.js"></script>
	<script type="text/javascript" src="js/ins.js"></script>
	<script type="text/javascript" src="js/createzv.js"></script>
	<script type="text/javascript" src="js/createzvp.js"></script>
	<script type="text/javascript" src="js/createprot.js"></script>
	<script type="text/javascript" src="js/createev.js"></script>
	<script type="text/javascript" src="js/createtb.js"></script>
</body>
</html>