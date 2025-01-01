<?php
include '../admin/dbconf.php';
session_start();

if (!isset($_SESSION['emailAccount'])) { 
    header('Location: signin.php');
    exit();
}

$email = $_SESSION['emailAccount'];
$sql = "SELECT name FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);$name = $row['name'];

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
            <a class="navbar-brand" href="#">CARS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Tutoriales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pagos.php">Historial Pagos</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-danger" onclick="location.href = 'logout.php';">Cerrar Sesion</button>
        </div>
    </nav>
    <?php echo("<h4>Hola, $name</h4>") ?>
    <div class="container spacingWebFix">
        <h2 class="text-center">Tutoriales de Reparacion</h2>
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0 mb3">
                <div class="card">
                    <div class="card-body">
                        <video width="100%" height="240" controls>
                            <source src="srcS3AWS" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <h5 class="card-title">Video Title</h5>
                        <p class="card-text">Description_here.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0 mb3">
                <div class="card">
                    <div class="card-body">
                        <video width="100%" height="240" controls>
                            <source src="msrcS3AWS" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <h5 class="card-title">Video Title</h5>
                        <p class="card-text">Description_here.</p>
                    </div>
                </div>
            </div>
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