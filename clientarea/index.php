<?php
include '../admin/dbconf.php';
session_start();

if (!isset($_SESSION['emailAccount'])) {
    header('Location: signin.php');
    exit();
}

$getVideos = "SELECT title, description, s3url FROM videos WHERE type='REPARACION'";
$obtainedVideos = mysqli_query($conn, $getVideos);

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

    <?php
    //Compruebo si esta suscrito a la plataforma
    $checkSuscription = "SELECT * FROM transactions WHERE userid = (SELECT id FROM users WHERE email = '$email')";
    $isSubscribed = mysqli_query($conn, $checkSuscription);
    if (mysqli_num_rows($isSubscribed) > 0) {
        ?>
        <div class="container spacingWebFix">
            <h2 class="text-center">Tutoriales de Reparacion</h2>
            <div class="row">
                <?php
                while ($rows = $obtainedVideos->fetch_assoc()) {
                    ?>

                    <div class="col-sm-6 mb-3 mb-sm-0 mb3">
                        <div class="card">
                            <div class="card-body">
                                <video width="100%" height="240" controls>
                                    <source src="<?php echo $rows['s3url']; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <h5 class="card-title"><?php echo $rows['title']; ?></h5>
                                <p class="card-text"><?php echo $rows['description']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card mt-5">
                        <div class="card-body text-center">
                            <h3 class="text-danger">
                                ¡No tienes una suscripcion activa!
                            </h3>
                            <p>No hemos podido encontrar ningun pago registrado en su cuenta, puede ser que seas un nuevo
                                cliente.</p>
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block mb-4" onclick="location.href = 'paynow.php';">Realizar
                                Pago</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>


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