<?php
session_start();
$estadoPeticion = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../admin/dbconf.php';        
    $email = trim($_POST['emailForm']);
    $password = trim($_POST['passwdForm']);
    
    $query = "SELECT * FROM users WHERE email = ? AND isadmin = 1 LIMIT 1";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['godMode'] = $email;
                header("location: index.php");
                exit();
            } else {
                $estadoPeticion = "Su contraseña no es correcta";
            }
        } else {
            $estadoPeticion = "Este usuario no existe o no tiene los privilegios requeridos";
        }
        
        $stmt->close();
    } else {
        $estadoPeticion = "No se puede procesar su solicitud en estos momentos";
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
                            Zona de Administracion
                        </h1>
                        <h4>
                            Introduzca sus credenciales para continuar
                        </h4>
                        <?php if (!empty($estadoPeticion)): ?>
                            <div class="alert alert-danger" role="alert">
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