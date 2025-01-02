<?php
include '../admin/dbconf.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nameForm'];
    $surname = $_POST['surnameForm'];
    $email = $_POST['emailForm'];
    $password = $_POST['passwdForm'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $checkEmailStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        echo '<script>alert("¡Este correo ya esta registrado!")</script>';
    } else {
        $stmt = $conn->prepare("INSERT INTO users (password, name, surname, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $hashed_password, $name, $surname, $email);

        if ($stmt->execute()) {
            echo '<script>alert("¡Tu cuenta ha sido creada con exito! Ya puedes iniciar sesion desde Area de Cliente")</script>';
        } else {
            echo '<script>alert("No hemos podido crear tu cuenta, contacta con nosotros para mas informacion")</script>';
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

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mt-5">
                    <div class="card-body text-center">
                        <img src="../media/img/logo.png" class="img-fluid mb-3" style="max-width: 250px;">
                        <h1 class="text-success">
                            Registrarse
                        </h1>
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
            <p class="mb-0">&copy; 2024 CARS. Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>