<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'kp_data');
define('DB_USER', 'root');
define('DB_PASS', '');

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your_gmail@gmail.com');
define('SMTP_PASS', 'your_gmail_app_password');
define('SMTP_ENCRYPTION', 'tls');

define('PROJECT_NAME', 'kpanel');
define('PROJECT_VERSION', '1.0.0');

function getPDO() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES utf8");
        return $pdo;
    } catch(PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function sendEmail($to, $subject, $body) {
    require_once __DIR__ . '/../vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port       = SMTP_PORT;

        $mail->setFrom(SMTP_USER, PROJECT_NAME);
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
    }
}