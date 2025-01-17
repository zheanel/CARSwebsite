<?php
include 'admin/dbconf.php';
$getVideos = "SELECT title, description, s3url FROM videos WHERE type='REVIEW'";
$obtainedVideos = mysqli_query($conn, $getVideos);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARS</title>
    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/app.css" rel="stylesheet">
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
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="reviews.php">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-info" onclick="location.href = 'clientarea/signin.php';">Area de
                Clientes</button>
        </div>
    </nav>
    <div class="container spacingWebFix">
        <h2 class="text-center">Reviews de Vehiculos</h2>
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