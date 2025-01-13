<?php
$estadoPeticion = "";
$tipoEstado = "alert-danger";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'admin/dbconf.php';
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $question = trim($_POST['question']);
    $addQuestion = "INSERT INTO contact_form (name, surname, email, question) VALUES (?, ?, ?, ?)";
    $stmtaddQuestion = $conn->prepare($addQuestion);
    $stmtaddQuestion->bind_param("ssss", $name, $surname, $email, $question);
    if ($stmtaddQuestion->execute()) {
        $tipoEstado = "alert-success";
        $estadoPeticion = "¡Enviado con exito! Pronto recibiras una respuesta 😊";
    } else {
        $estadoPeticion = "Se ha producido un error al enviar el formulario, intentalo mas tarde.";
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
                        <a class="nav-link" href="reviews.php">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-info" onclick="location.href = 'clientarea/signin.php';">Area de
                Clientes</button>
        </div>
    </nav>
    <div class="container spacingWebFix">
        <h2 class="text-center">Formulario de Contacto</h2>
        <?php if (!empty($estadoPeticion)): ?>
            <div class="alert <?php echo $tipoEstado ?>" role="alert">
                <?php echo htmlspecialchars($estadoPeticion); ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" aria-label="name" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="surname" name="surname" aria-label="surname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tu correo electrónico con
                    nadie.</small>
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Escribe aquí:</label>
                <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="terms" required>
                <label class="form-check-label" for="exampleCheck1">
                    Al enviar este formulario, acepto el tratamiento de los datos facilitados a CARS S.L para fines de
                    comunicación.
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

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