<?php
include '../admin/dbconf.php';
include 'answnum.php';
session_start();
$estadoPeticion = "";
$tipoEstado = "alert-danger";

if (!isset($_SESSION['godMode'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['godMode'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $s3url = trim($_POST['s3url']);
    $type = trim($_POST['videoType']);
    $uploadVideo = "INSERT INTO videos (title, description, s3url, type) VALUES (?, ?, ?, ?)";
    $stmtvideoUpload = $conn->prepare($uploadVideo);
    $stmtvideoUpload->bind_param("ssss", $title, $description, $s3url, $type);

    if ($stmtvideoUpload->execute()) {
        $tipoEstado = "alert-success";
        $estadoPeticion = "¡Video $title agregado con exito!";
    } else {
        $estadoPeticion="Se ha producido un error al subir el video";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARS</title>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/app.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container container-fluid">
            <a class="navbar-brand" href="#">CARS - Administracion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gestion Contenido
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php">Mostrar Videos</a></li>
                            <li><a class="dropdown-item active" href="#">Añadir Video</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usermanager.php">Gestionar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="questions.php">Preguntas <span class="badge badge-light"><?php echo $unanswered ?></span></a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-danger" onclick="location.href = 'logout.php';">Cerrar Sesion</button>
        </div>
    </nav>
    <div class="container spacingWebFix">
        <h5 class="text-center">
            <strong>Agregar nuevo video a la plataforma</strong>
        </h5>
        <?php if (!empty($estadoPeticion)): ?>
            <div class="alert <?php echo $tipoEstado ?>" role="alert">
                <?php echo htmlspecialchars($estadoPeticion); ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Titulo:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripcion:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="s3url" class="form-label">Enlace S3 (Video):</label>
                <input type="text" class="form-control" id="s3url" name="s3url" required>
            </div>
            <div class="mb-3">
                <label for="videoType" class="form-label">Tipo de Video:</label>
                <select class="form-select" id="videoType" name="videoType" required>
                    <option value="REVIEW">REVIEW</option>
                    <option value="REPARACION">REPARACION</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Video</button>
        </form>

    </div>



    <!-- Footer -->
    <footer class="bg-dark text-light py-3">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> CARS. Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>