<?php
include '../admin/dbconf.php';
session_start();

if (!isset($_SESSION['godMode'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['godMode'];

$users = "SELECT id, name, surname, email FROM users";
$stmtusers = $conn->prepare($users);
$stmtusers->execute();
$resultusers = $stmtusers->get_result();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail= $_POST['userID'];
    //Elimino Transacciones
    $sqlDelPayments= "DELETE FROM transactions WHERE userid = ?";
    $stmtDelPayments = $conn->prepare($sqlDelPayments);
    $stmtDelPayments->bind_param("i", $userEmail);
    if ($stmtDelPayments->execute()) {
        //Elimino Datos del Usuario
        $sqlDelUser= "DELETE FROM users WHERE id = ? and isadmin = 0";
        $stmtdelete = $conn->prepare($sqlDelUser);
        $stmtdelete->bind_param("i", $userEmail);
    }   if ($stmtdelete->execute()) {
        header('Location: usermanager.php');
        } else {
        echo ("<script>alert(Error al eliminar el usuario)</script>");
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gestion Contenido
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php">Mostrar Videos</a></li>
                            <li><a class="dropdown-item" href="addvideo.php">Añadir Video</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Gestionar Usuarios</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-danger" onclick="location.href = 'logout.php';">Cerrar Sesion</button>
        </div>
    </nav>
    <div class="container spacingWebFix">
    <h5 class="text-center">
        <strong>Usuarios activos en la plataforma</strong>
    </h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electronico</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultusers && $resultusers->num_rows > 0) {
                    while ($row = $resultusers->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['surname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo '<td><form method="post"><button type="submit" name="userID" value="' . htmlspecialchars($row['id']) . '" class="btn btn-danger">Eliminar</button></form></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay ningun usuario dado de alta</td></tr>";
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