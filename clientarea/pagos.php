<?php
include '../admin/dbconf.php';
session_start();

if (!isset($_SESSION['emailAccount'])) {
    header('Location: signin.php');
    exit();
}

$email = $_SESSION['emailAccount'];

$payments = "SELECT date, payment_amount FROM transactions WHERE userid = (SELECT id FROM users WHERE email = ?)";
$stmtPayments = $conn->prepare($payments);
$stmtPayments->bind_param("s", $email);
$stmtPayments->execute();
$resultpayments = $stmtPayments->get_result();
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
                        <a class="nav-link" href="index.php">Tutoriales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="pagos.php">Historial Pagos</a>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-danger" onclick="location.href = 'logout.php';">Cerrar Sesion</button>
        </div>
    </nav>
    <div class="container spacingWebFix">
        <h2 class="text-center">Historial de pagos</h2>
        <h6 class="text-center">
            <?php if ($resultpayments->num_rows > 0) {
                echo ("Llevas $resultpayments->num_rows mes(es) suscrito a la plataforma");
            } else {
                echo ("Nunca has estado suscrito a la plataforma");
            } ?>
        </h6>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cantidad (€)</th>
                    <th>Correo Asociado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultpayments && $resultpayments->num_rows > 0) {
                    while ($row = $resultpayments->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['payment_amount']) . "</td>";
                        echo "<td>" . htmlspecialchars($email) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No se encontraron pagos.</td></tr>";
                }
                ?>
            </tbody>
        </table>
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