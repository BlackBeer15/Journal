<?php
	include_once('dbcon.php');
	$i = 0;
	$j = 0;
	$studo = mysqli_query($connect, "SELECT `idstudent` from `student` left join `group` on `idGroup` = `group` where `namegro`='".$_POST['parGr']."' ORDER By `fio`");
	foreach ($studo as $row) {
		$date = mysqli_query($connect, "SELECT DISTINCT `date` from `rate` ORDER BY `date` ASC");
		foreach ($date as $row1) {
			$rat = mysqli_query($connect, "SELECT `idRate` from `rate` where `student` =".$row['idstudent']." and `date` = '".$row1['date']."'");
			foreach ($rat as $row2) {
				$update = mysqli_query($connect, "UPDATE `rate` SET `rate` = ".$_POST[$j.'_'.$i]." WHERE `rate`.`idRate` = ".$row2['idRate']."");
			}
			$j++;
		}
		$i++;
		$j=0;
	}
?>