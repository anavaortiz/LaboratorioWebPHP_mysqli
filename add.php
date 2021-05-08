<?php

include('config/db_connect.php');

$Email = '';
$NombrePizza = '';
$Ingredientes = '';

$errors = array('Email'=>'', 'NombrePizza'=>'', 'Ingredientes'=>'');

if(isset($_POST['submit'])){
	
	// ... revisa correo ....
	if(empty($_POST['Email'])){
		$errors['Email'] = 'Se requiere un correo electrónico (email)';
	} else {
		$Email = $_POST['Email'];
		if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
			$errors['Email'] = 'El correo electrónico debe de ser válido';
		}
	}
	
	// ... validar nombre pizza...
	if(empty($_POST['NombrePizza'])){
		$errors['NombrePizza'] = 'Se requiere el nombre de la pizza';
	} else {
		$NombrePizza = $_POST['NombrePizza'];
		if(!preg_match('/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/', $NombrePizza)){
			$errors['NombrePizza'] = "El nombre debe tener letras y espacios solamente";
		}
	}// ... valida los ingredientes ...
	if(empty($_POST['Ingredientes'])){
		$errors['Ingredientes'] = 'Se necesita por lo menos un ingrediente';
	} else {
		$Ingredientes = $_POST['Ingredientes'];
		if(!preg_match('/^([0-9a-zA-Z ñÑáéíóúÁÉÍÓÚ_-])+((,\s*)+([0-9a-zA-Z ñÑáéíóúÁÉÍÓÚ_-]*)*)+$/', $Ingredientes)){
			$errors['Ingredientes'] = 'Los ingredientes deben de estar separados por una coma';
		}
	}
	
	if(array_filter($errors)){
		#echo 'Hay errores en el formulario';
	} else {
		$Email = mysqli_real_escape_string($conn, $_POST['Email']);
		$NombrePizza = mysqli_real_escape_string($conn, $_POST['NombrePizza']);
		$Ingredientes = mysqli_real_escape_string($conn, $_POST['Ingredientes']);
		
		$strQuery = "INSERT INTO Pizza(NombrePizza, Email, Ingredientes) VALUES ('$NombrePizza', '$Email', '$Ingredientes')";
		
		if(mysqli_query($conn,$strQuery)){
			header('location: index.php');
		} else {
			echo 'Ha ocurrido un error en el query ' . mysqli_error($conn);
		}
	}
	
	
	
}

?>


<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>
	
	<section class="container grey-text">
		<h4 class="center">Agregar pizzas</h4>
		<form class="white" action=<?php echo $_SERVER['PHP_SELF']; ?> method = "POST">
			<label>Su correo:</label>
			<input type="text" name="Email" value="<?php echo htmlspecialchars($Email) ?>">
			<div class="red-text"><?php echo $errors['Email']; ?></div>
			
			<label>Nombre pizza:</label>
			<input type="text" name="NombrePizza" value="<?php echo htmlspecialchars($NombrePizza) ?>">
			<div class="red-text"><?php echo $errors['NombrePizza']; ?></div>
			
			<label>Ingredientes</label>
			<input type="text" name="Ingredientes" value="<?php echo htmlspecialchars($Ingredientes) ?>">
			<div class="red-text"><?php echo $errors['Ingredientes']; ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit"
						class="btn brand z-depth-0">
			</div>
		</form>
		
		
	<?php include('templates/footer.php') ?>
</html>
