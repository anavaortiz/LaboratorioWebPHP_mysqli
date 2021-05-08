<?php
	// ... conexión a base de datos ...
	$conn = mysqli_connect('localhost','profesor','Pepino76$','LabWeb');
	
	// ... revisa conexión ...
	if(!$conn){
		echo 'Error de conexión: ' . mysqli_connect_error();
	}
?>
