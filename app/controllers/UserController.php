<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        require __DIR__ . '/../views/dashboard/users.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->createUser($_POST);
            header('Location: /dashboard/users');
            exit;
        }
        $pageTitle = "Crear Usuario";
        $contentFile = __DIR__ . '/../views/users/create.php';
        require __DIR__ . '/../views/dashboard/layout.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->updateUser($id, $_POST);
            header('Location: /dashboard/users');
            exit;
        }
        $user = $this->userModel->getUserById($id);
        $pageTitle = "Editar Usuario";
        $contentFile = __DIR__ . '/../views/users/edit.php';
        require __DIR__ . '/../views/dashboard/layout.php';
    }

    public function delete($id) {
        $user = $this->userModel->getUserById($id);
        if ($this->userModel->deleteUser($id)) {
            $to = 'admin@example.com'; // Cambia esto por el correo del administrador
            $subject = 'Usuario Eliminado';
            $body = $this->getDeleteUserEmailBody($user);
            sendEmail($to, $subject, $body);
        }
        header('Location: /dashboard/users');
        exit;
    }

    private function getDeleteUserEmailBody($user) {
        return "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #f4f4f4; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                .footer { background-color: #f4f4f4; padding: 10px; text-align: center; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Usuario Eliminado</h1>
                </div>
                <div class='content'>
                    <p>Se ha eliminado el siguiente usuario del sistema:</p>
                    <ul>
                        <li><strong>Nombre:</strong> {$user['name']}</li>
                        <li><strong>Email:</strong> {$user['email']}</li>
                        <li><strong>Tipo:</strong> " . ($user['type'] === 'D' ? 'Doctor' : 'Administrador') . "</li>
                    </ul>
                    <p>Esta acción se realizó el " . date('d/m/Y H:i:s') . ".</p>
                </div>
                <div class='footer'>
                    <p>Este es un mensaje automático, por favor no responda.</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}