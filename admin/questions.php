<?php
include '../admin/dbconf.php';
include 'answnum.php';
session_start();

if (!isset($_SESSION['godMode'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['godMode'];

$contact = "SELECT id, name, surname, email, question, answered FROM contact_form WHERE answered = 0";
$stmtcontact = $conn->prepare($contact);
$stmtcontact->execute();
$resultcontact = $stmtcontact->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formID = $_POST['answerID'];
    $sqlUpdAnswer = "UPDATE contact_form SET answered = 1 WHERE id = ?";
    $stmtUpdAnswer = $conn->prepare($sqlUpdAnswer);
    $stmtUpdAnswer->bind_param("i", $formID);
    if ($stmtUpdAnswer->execute()) {
        header('Location: questions.php');
        exit();
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
                            <li><a class="dropdown-item" href="addvideo.php">Añadir Video</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usermanager.php">Gestionar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Preguntas <span class="badge badge-light"><?php echo $unanswered ?></span></a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-danger" onclick="location.href = 'logout.php';">Cerrar Sesion</button>
        </div>
    </nav>
    <div class="container spacingWebFix">
    <h5 class="text-center">
        <strong>Ver las preguntas enviadas por los usuarios</strong>
    </h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electronico</th>
                    <th>Pregunta</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultcontact && $resultcontact->num_rows > 0) {
                    while ($row = $resultcontact->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['surname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td><textarea readonly disabled style='resize: none;' rows='4'>". htmlspecialchars($row['question']) . "</textarea>";
                        echo '<td><form method="post"><button type="submit" name="answerID" value="' . htmlspecialchars($row['id']) . '" class="btn btn-success">Marcar como respondido</button></form></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No existen solicitudes pendientes</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
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