<?php
include '../admin/dbconf.php';
session_start();

if (!isset($_SESSION['godMode'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['godMode'];

$videos = "SELECT title, description, s3url, type, created_on FROM videos";
$stmtvideos = $conn->prepare($videos);
$stmtvideos->execute();
$resultvideos = $stmtvideos->get_result();
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
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Listado de Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addvideo.php">Agregar Video</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-danger" onclick="location.href = 'logout.php';">Cerrar Sesion</button>
        </div>
    </nav>
    <div class="container spacingWebFix">
    <h5 class="text-center">
        <strong>Listado de videos subidos</strong>
    </h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th>Fecha de Subida</th>
                    <th>Enlace</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultvideos && $resultvideos->num_rows > 0) {
                    while ($row = $resultvideos->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_on']) . "</td>";
                        echo '<td><a href="' . htmlspecialchars($row['s3url']) . '" class="btn btn-primary">Ver Recurso</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No existen videos en la plataforma.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



    <!-- Footer -->
    <footer class="bg-dark text-light py-3">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 CARS. Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>