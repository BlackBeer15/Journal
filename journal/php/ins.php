<?php
	include_once('dbcon.php');
	$date = date("y.m.d");
	$selectidgr = mysqli_query($connect, "SELECT `idGroup` FROM `group` WHERE `namegro` = '".$_POST['parGr']."'");
	foreach ($selectidgr as $key) {
		$selectidstudsub = mysqli_query($connect, "SELECT `idStudent`, `idSubject` FROM `student`, `Subject` WHERE `group` = ".$key['idGroup']." AND `namesub` = '".$_POST['parSub']."'");
		foreach ($selectidstudsub as $key1) {
			$newdate = mysqli_query($connect, "INSERT INTO `rate` (`idRate`, `student`, `subject`, `rate`, `date`) VALUES (NULL, ".$key1['idStudent'].", ".$key1['idSubject'].", NULL, '".$date."'); ");
		}
	}
?>