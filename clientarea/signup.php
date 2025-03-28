<?php
include '../admin/dbconf.php';
$estadoPeticion = "";
$tipoEstado = "alert-danger";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['nameForm']);
    $surname = trim($_POST['surnameForm']);
    $email = trim($_POST['emailForm']);
    $password = trim($_POST['passwdForm']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $checkEmailStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        $estadoPeticion = "Este correo electronico ya esta registrado, utilize otro.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $surname, $email, $hashed_password);

        if ($stmt->execute()) {
            $tipoEstado = "alert-success";
            $estadoPeticion = "¡Cuenta creada con exito!";
        } else {
            $estadoPeticion = "No hemos podido crear tu cuenta, contacta con nosotros para mas informacion";
        }

        $stmt->close();
    }

    $checkEmailStmt->close();
    $conn->close();
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

<body class="bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mt-5">
                    <div class="card-body text-center">
                        <img src="../media/img/logo.png" class="img-fluid mb-3" style="max-width: 250px;">
                        <h1 class="text-success">
                            Registrarse
                        </h1>
                        <?php if (!empty($estadoPeticion)): ?>
                            <div class="alert <?php echo $tipoEstado ?>" role="alert">
                                <?php echo htmlspecialchars($estadoPeticion); ?>
                                <?php if ($tipoEstado === "alert-success") {
                                    echo '<a href="signin.php">Acceder al area de cliente</a>';
                                } ?>
                            </div>
                        <?php endif; ?>
                        <br>
                        <form method="post" style="text-align: left;">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="nameFrom"><strong>Nombre:</strong></label>
                                <input type="text" name="nameForm" class="form-control"  />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="surnameFrom"><strong>Apellido 1:</strong></label>
                                <input type="text" name="surnameForm" class="form-control"  />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="emailForm"><strong>Correo Electronico:</strong></label>
                                <input type="text" name="emailForm" class="form-control"  />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="passwdForm"><strong>Contraseña:</strong></label>
                                <input type="password" name="passwdForm" class="form-control" />
                            </div>

                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block mb-4">Registrarse</button>

                            <div class="text-center">
                                <p>¿Ya eres cliente? <a href="signin.php">Iniciar Sesion</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>


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