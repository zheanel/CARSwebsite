<?php
include '../admin/dbconf.php';
session_start();

if (!isset($_SESSION['godMode'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['godMode'];

$videos = "SELECT id, title, description, s3url, type, created_on FROM videos";
$stmtvideos = $conn->prepare($videos);
$stmtvideos->execute();
$resultvideos = $stmtvideos->get_result();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoID= $_POST['videoID'];
    $sqlDel= "DELETE FROM videos WHERE id = ?";
    $stmtdelete = $conn->prepare($sqlDel);
    $stmtdelete->bind_param("i", $videoID);
    if ($stmtdelete->execute()) {
        header('Location: index.php');
    } else {
        echo ("<script>alert(Error al eliminar el video seleccionado)</script>");
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
                            <li><a class="dropdown-item active" href="#">Mostrar Videos</a></li>
                            <li><a class="dropdown-item" href="addvideo.php">Añadir Video</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usermanager.php">Gestionar Usuarios</a>
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
                    <th>Opciones</th>
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
                        echo '<td><a href="' . htmlspecialchars($row['s3url']) . '" class="btn btn-primary">Ver Recurso</a> <form method="post"><button type="submit" name="videoID" value="' . htmlspecialchars($row['id']) . '" class="btn btn-danger">Eliminar</button></form></td>';
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