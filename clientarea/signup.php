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
                        <form style="text-align: left;">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="nameFrom"><strong>Nombre:</strong></label>
                                <input type="text" id="nameForm" class="form-control"  />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="surnameFrom"><strong>Apellido 1:</strong></label>
                                <input type="text" id="surnameForm" class="form-control"  />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="emailForm"><strong>Correo Electronico:</strong></label>
                                <input type="text" id="emailForm" class="form-control"  />
                            </div>
                            
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="userFrom"><strong>Usuario:</strong></label>
                                <input type="text" id="userForm" class="form-control"  />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="passwdForm"><strong>Contraseña:</strong></label>
                                <input type="password" id="passwdForm" class="form-control" />
                            </div>

                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block mb-4">Registrarse</button>

                            <div class="text-center">
                                <p>¿Ya eres cliente? <a href="/clientarea/signin.html">Iniciar Sesion</a></p>
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