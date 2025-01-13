<?php
session_start();
session_destroy();

ob_flush();
flush();

echo '<script>
    alert("Has cerrado sesión, ¡vuelve pronto!");
    window.location.href = "signin.php";
</script>';
?>
