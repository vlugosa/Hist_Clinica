<?php
require '../includes/app.php';

incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Bienvenido Historia Clinica</h1>

    <span><?php echo "Usuario: " . $_SESSION['usuario']; ?></span>
</main>
<?php
incluirTemplate('footer');
?>