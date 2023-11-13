<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ftp_server = 'radio.islacristina.org';
        $ftp_user = 'radio.islacristina.org';
        $ftp_password = 'Higuerita04';
        $ftp_port = 21;
        $ftp_folder = 'html/pruebas/';
        $remote_file = 'readme.txt';

        if (isset($_POST['archivo'])) {
            $archivo = $_POST['archivo'];

            $ftp_connection = ftp_connect($ftp_server, $ftp_port) or die("No se pudo conectar al servidor FTP");
            
            if (ftp_login($ftp_connection, $ftp_user, $ftp_password)) {

                if (ftp_put($ftp_connection, $remote_file, $archivo, FTP_BINARY)) {
                    echo "Archivo subido correctamente";
                } else {
                    $last_error = error_get_last();
                    echo "Error al subir archivo al FTP: " . $last_error['message'];
                }
                ftp_close($ftp_connection);
            } else {
                echo "No se puede conectar al servidor de FTP";
            }
        } else {
            echo "No has subido ningún archivo";
        }
    } else {
        header("Location: subir.html");
        exit();
    }
?>
<!--
    $ftp_server = "ftp.example.com"; // Cambia esto al servidor FTP al que deseas conectarte
    $ftp_username = "tu_usuario_ftp"; // Cambia esto a tu nombre de usuario FTP
    $ftp_password = "tu_contraseña_ftp"; // Cambia esto a tu contraseña FTP
    $local_file = "archivo_local.txt"; // Ruta al archivo local que deseas subir
    $remote_file = "archivo_remoto.txt"; // Ruta en el servidor FTP donde deseas guardar el archivo

    // Conexión al servidor FTP
    $ftp_connection = ftp_connect($ftp_server) or die("No se pudo conectar al servidor FTP");

    // Iniciar sesión en el servidor FTP
    if (ftp_login($ftp_connection, $ftp_username, $ftp_password)) {
        // Intentar subir el archivo
        if (ftp_put($ftp_connection, $remote_file, $local_file, FTP_BINARY)) {
            echo "Archivo subido exitosamente";
        } else {
            echo "Error al subir el archivo";
        }

        // Cerrar la conexión FTP
        ftp_close($ftp_connection);
    } else {
        echo "No se pudo iniciar sesión en el servidor FTP";
    }
-->
