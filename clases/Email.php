<?php

namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        //Crear una instancia de PHPMailer
        $phpmailer = new PHPMailer();
                            
        //Configurar SMPT
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '761e95bf2e740b';
        $phpmailer->Password = '9549054983563c';
        $phpmailer->SMTPSecure = 'tls';

        //Configurar el contenido del email
        $phpmailer->setFrom('cuentas@appsalon.com');
        $phpmailer->addAddress($this->email);
        $phpmailer->Subject = 'Confirma tu cuenta';

        //Habilitar HTML
        $phpmailer->isHTML(true);
        $phpmailer->Charset = 'UTF-8';

        //Definir el contenido
        $contenido = "<html><p>Hola <strong>" . $this->nombre . "</strong>. Has creado tu cuenta en AppSalon, solo debes confirmar la misma presionando el siguiente enlace</p><p>Presiona aqui: <a href='";

        if($_SERVER['SERVER_NAME'] == 'localhost'){
            $contenido .= "http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p><p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p></html>";;
        }else{
            $contenido .= "https://peluqueria-barberia-nqn.herokuapp.com/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p><p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p></html>";;
        }

        



        $phpmailer->Body = $contenido;
        $phpmailer->AltBody = 'Esto es texto alternativo sin HTML';

        //Enviar el mail
        return $phpmailer->send();
    }

    public function enviarInstrucciones(){
        //Crear una instancia de PHPMailer
        $phpmailer = new PHPMailer();
                            
        //Configurar SMPT
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'ee2baab5b66286';
        $phpmailer->Password = 'f37a662eb6439a';
        $phpmailer->SMTPSecure = 'tls';

        //Configurar el contenido del email
        $phpmailer->setFrom('cuentas@appsalon.com');
        $phpmailer->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $phpmailer->Subject = 'Reestablece tu password';

        //Habilitar HTML
        $phpmailer->isHTML(true);
        $phpmailer->Charset = 'UTF-8';

        //Definir el contenido
        $contenido = "<html><p>Hola <strong>" . $this->nombre . "</strong>. Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p><p>Presiona aqui: <a href='";

        if($_SERVER['SERVER_NAME'] == 'localhost'){
            $contenido .= "http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p><p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p></html>";
        }else{
            $contenido .= "https://peluqueria-barberia-nqn.herokuapp.com/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p><p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p></html>";
        }

        $phpmailer->Body = $contenido;
        $phpmailer->AltBody = 'Esto es texto alternativo sin HTML';

        //Enviar el mail
        return $phpmailer->send();
    }

    public function confirmacionCita($cita, $servicios){
        //Crear una instancia de PHPMailer
        $phpmailer = new PHPMailer();
                            
        //Configurar SMPT
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'ee2baab5b66286';
        $phpmailer->Password = 'f37a662eb6439a';
        $phpmailer->SMTPSecure = 'tls';

        //Configurar el contenido del email
        $phpmailer->setFrom('cuentas@appsalon.com');
        $phpmailer->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $phpmailer->Subject = 'Confirmación de turno';

        //Habilitar HTML
        $phpmailer->isHTML(true);
        $phpmailer->Charset = 'UTF-8';

        //Definir el contenido
        $contenido = "<html><p>Hola <strong>" . $this->nombre . "</strong>. Tu cita ha sido confirmada con éxito.</p><p>Datos de la cita:</p><p>Lugar: " . $cita->direccion . "</p><p>Fecha: " . $cita->fecha . "</p><p>Hora: " . $cita->hora . "</p><p>Total a pagar: " . $cita->total . "</p><u>Servicios</u>";
        


        foreach($servicios as $servicio) {
            $contenido .= "<p>" . $servicio->nombre . " $" . ($servicio->precio * ((100 - $servicio->oferta) / 100)) . "</p>";
        }

        $contenido .= "</br><p>Te Esperamos!</p><p><strong>Importante:</strong> recuerda que debes presentarte a horario, en caso de que pasen 15 minutos de demora el turno será cancelado</p><p><strong>Cancelar turno:</strong> en caso de no poder asistir al turno, avisar por uno de los siguientes medios: <a href='https://www.whatsapp.com/'>Whatsapp</a> - <a href='https://www.instagram.com/'>Instagram</a> - <a href='https://www.facebook.com/'>Facebook</a></p></html>";

        $phpmailer->Body = $contenido;
        $phpmailer->AltBody = 'Esto es texto alternativo sin HTML';

        //Enviar el mail
        return $phpmailer->send();
    }
}