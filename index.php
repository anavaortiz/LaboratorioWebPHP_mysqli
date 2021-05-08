<?php 
	// ... MYSQLi (mysql improved) .... PDO (php data object)
	
	include('config/db_connect.php');
	
	$strQuery = 'SELECT IdCliente, NombrePizza, Ingredientes FROM Pizza ORDER BY created_at';
	
	$result = mysqli_query($conn, $strQuery);
	
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	
	
	mysqli_free_result($result);
	
	mysqli_close($conn);
	
	//print_r($pizzas);
	
	
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php') ?>
	
	<h4 class="center grey-text">Pizzas!</h4>
	
	<div class="container">
		<div class="row">
			<?php foreach($pizzas as $pizza): ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php 
								echo htmlspecialchars($pizza['NombrePizza']); 
								?>
							</h6>
							<ul>
								<?php foreach(explode(',', $pizza['Ingredientes']) as $ing): ?>
									<li><?php echo htmlspecialchars($ing); ?>	
									</li>
								<?php endforeach;?>
							</ul>
							<div class="card-action right-align">
								<a class="brand-text" href="details.php?id=<?php echo $pizza['IdCliente'] ?>">
									más información
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div> 
	
	<?php include('templates/footer.php') ?>
	
	
</html>
