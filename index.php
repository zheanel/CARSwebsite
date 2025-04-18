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
    <nav class="navbar navbarFixed navbar-expand-lg navbar-dark bg-dark">
        <div class="container container-fluid">
            <a class="navbar-brand" href="#">CARS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reviews.php">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-info" onclick="location.href = 'clientarea/signin.php';">Area de Clientes</button>
        </div>
    </nav>
    <video autoplay muted loop id="bg-web">
        <source src="./media/video/main-header-bg.mp4" type="video/mp4">
      </video>

    <header class="text-light py-5 text-center" id="texto_web">
        <div class="container" id="header_txt">
            <h1 class="display-4">CARS | Opiniones y Guias</h1>
            <p class="lead">Nosotros manejamos la información, tú el volante.</p>
            <a href="reviews.php" class="btn btn-primary btn-lg mt-3">Explorar Contenido</a>
        </div>
    </header>

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
