<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validar datos
    if (empty($name) || empty($email) || empty($message) || empty($telefono)) {
        echo '<p>Por favor, complete todos los campos.</p>';
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p>Por favor, ingrese un correo electrónico válido.</p>';
        exit;
    }

    // Puede enviar el correo aquí usando mail() o almacenar los datos en una base de datos
    // Ejemplo de envío de correo (asegúrese de tener configurado el servidor de correo):
    $to = 'ventas@ideasystems.com.mx';  // Reemplace con su dirección de correo
    $subject = 'CONTACTO DESDE SITIO WEB';
    $body = "Nombre: $name\nCorreo Electrónico: $email\nMensaje:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo '<p>Gracias, su mensaje ha sido enviado.</p>';
    } else {
        echo '<p>Ocurrió un error al enviar su mensaje.</p>';
    }
}
?>
