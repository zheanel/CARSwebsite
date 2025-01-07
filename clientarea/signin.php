<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../admin/dbconf.php';        
    $email = mysqli_real_escape_string($conn, $_POST['emailForm']);
    $password = mysqli_real_escape_string($conn, $_POST['passwdForm']);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $estadoPeticion= "";

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            
            $hashedPassword = $row['password'];
            
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['emailAccount'] = $email;
                header("location: index.php");
                exit();
            } else {
                $estadoPeticion = "Contraseña incorrecta";
            }
        } else {
            $estadoPeticion = "Correo electronico no valido";
        }
    } else {
        $estadoPeticion = "No hemos podido procesar tu peticion en estos momentos";
    }
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

<body class="bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mt-5">
                    <div class="card-body text-center">
                        <img src="../media/img/logo.png" class="img-fluid mb-3" style="max-width: 250px;">
                        <h1 class="text-success">
                            Area de Clientes
                        </h1>
                        <h4>
                            Introduzca sus credenciales para continuar
                        </h4>
                        <?php if (!empty($estadoPeticion)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo htmlspecialchars($estadoPeticion); ?>
                            </div>
                        <?php endif; ?>
                        <br>
                        <form method="post" style="text-align: left;">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="emailForm"><strong>Correo Electronico:</strong></label>
                                <input type="text" name="emailForm" class="form-control"  />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="passwdForm"><strong>Contraseña:</strong></label>
                                <input type="password" name="passwdForm" class="form-control" />
                            </div>
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block mb-4">Iniciar Sesion</button>

                            <div class="text-center">
                                <p>¿Eres nuevo? <a href="signup.php">Registrarse</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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