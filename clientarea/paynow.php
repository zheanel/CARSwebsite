<?php
include '../admin/dbconf.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    if (!isset($_SESSION['emailAccount'])) {
        header('Location: signin.php');
        exit();
    }

    $email = $_SESSION['emailAccount'];
    $sql = "
        INSERT INTO transactions
        VALUES (
            (SELECT id FROM users WHERE email = '$email'),
            NOW(),
            '10'
        )
    ";
    $result = mysqli_query($conn, $sql);
    $conn->close();
    echo "<script>
    alert('Pago completado con exito!');
    setTimeout(function() {
        window.location.href = 'index.php';
    }, 250);
</script>";

}
?>

</html>
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mt-5">
                    <div class="card-body text-center">
                        <h3 class="text-info">
                            Activacion de Suscripcion
                        </h3>
                        <br>
                        <form method="post" style="text-align: left;">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="nameForm"><strong>Nombre:</strong></label>
                                <input type="text" name="nameForm" class="form-control" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="ccForm"><strong>Numero de tarjeta:</strong></label>
                                <input type="text" name="ccForm" class="form-control" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="dateForm"><strong>Fecha de Caducidad:</strong></label>
                                <input type="text" name="dateForm" class="form-control" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="ccvForm"><strong>Codigo Secreto (CCV):</strong></label>
                                <input type="text" name="ccvForm" class="form-control" />
                            </div>
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block mb-4">Pagar 10,00€</button>
                        </form>
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