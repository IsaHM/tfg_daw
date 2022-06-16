<!--
    La web debe estar desplegada en un servidor para que este código envíe el mensaje al email aportado
-->

<?php
    $direccion_email = "isabel.heredia2@educa.madrid.org";
    
    if(isset($_POST['submit'])) {
        $asunto = "Mensaje desde la plataforma.";
        $nombre = $_POST['nombre_contacto'];
        $email = $_POST['email_contacto'];
        $mensaje = $_POST['mensaje'];
        $cabecera = "From: Contact Form <" . $direccion_email . ">" . "\r\n";
        $cabecera .= "Reply-To: " . $nombre . " <" . $email .">" . "\r\n";
        
        mail($direccion_email, $asunto, $mensaje, $cabecera);
        echo '<script type="text/javascript">
            alert("Tu mensaje ha sido enviado correctamente.");
            location="landpage.php";
        </script>';
    } else {
        echo '<script type="text/javascript">
            alert("Ha ocurrido un error al enviar el mensaje. Por favor, inténtalo de nuevo.");
            location="landpage.php";
        </script>';
    }
?>