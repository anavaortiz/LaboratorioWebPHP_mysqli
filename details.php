<?php

include('config/db_connect.php');


if(isset($_POST['delete'])){
	$id_a_borrar = mysqli_real_escape_string($conn, $_POST['id_a_borrar']);
	$strQueryBorrar = "DELETE FROM Pizza WHERE IdCliente = $id_a_borrar";
	
	print_r($strQueryBorrar);
	if(mysqli_query($conn,$strQueryBorrar)){
		header('Location: index.php');
	} else {
		echo 'Error de consulta: ' . mysqli_error($conn);
	}
}


if(isset($_GET['id'])){
	$id = mysqli_real_escape_string($conn, $_GET['id']);
	
	$strQuery = "SELECT * FROM Pizza WHERE IdCliente = $id";
	
	$results = mysqli_query($conn, $strQuery);
	
	$pizza = mysqli_fetch_assoc($results);
	
	mysqli_free_result($results);
	mysqli_close($conn);
	
}

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>
	
	<div class="container center grey-text">
		<?php if($pizza): ?>
			<h3>
				<?php echo htmlspecialchars($pizza['NombrePizza']); ?>
			</h3>
			<p>Creada por: <?php echo htmlspecialchars($pizza['Email']); ?></p>
			<h5>Ingredientes: </h5>
			<p><?php echo htmlspecialchars($pizza['Ingredientes']); ?></p>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<input type="hidden" name="id_a_borrar" value="<?php echo $pizza['IdCliente']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
			
			
		<?php else: ?>
			<h5>Pizza no existe</h5>
		<?php endif; ?>
	</div>
	
	<?php include('templates/footer.php'); ?>
	
</html>
