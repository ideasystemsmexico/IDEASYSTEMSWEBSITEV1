<?php
// Datos de conexión a la base de datos
$host = "localhost"; // Cambiar por la dirección del servidor de la base de datos
$usuario = "ideasyst_k1"; // Cambiar por el nombre de usuario de la base de datos
$password = "Chalquintin2?"; // Cambiar por la contraseña de la base de datos
$nombreBD = "ideasyst_k1"; // Cambiar por el nombre de la base de datos

// Establecer conexión
$conexion = mysqli_connect($host, $usuario, $password, $nombreBD);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
		$sql = "SELECT id, nombre FROM temas WHERE id = 11;";
									$result = $conexion->query($sql);

									echo '<ul class="nav nav-tabs col-sm-3" role="tablist">';
									// Imprimir los resultados en forma de lista
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$id = $row["id"];
											$nombre = $row["nombre"];
											echo '<li class="nav-item" role="presentation"><a class="nav-link active" href="#tabsNavigation' . $id . '" data-bs-toggle="tab" aria-selected="true" role="tab"><i class="fas fa-users"></i>' . $nombre . '</a></li>';
										}
										echo "";
									} else {
										echo "No se encontraron resultados.";
									}

									?>
									</ul>
echo "Conexión exitosa a la base de datos";

// Cerrar la conexión
mysqli_close($conexion);
?>
