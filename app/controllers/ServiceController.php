<?php
require_once __DIR__ . '/../models/Service.php';

class ServiceController {
    private $serviceModel;

    public function __construct() {
        $this->serviceModel = new Service();
    }

    public function index() {
        $services = $this->serviceModel->getAllServices();
        require __DIR__ . '/../views/dashboard/services.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->serviceModel->createService($_POST);
            header('Location: /dashboard/services');
            exit;
        }
        $pageTitle = "Crear Servicio";
        $contentFile = __DIR__ . '/../views/services/create.php';
        require __DIR__ . '/../views/dashboard/layout.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->serviceModel->updateService($id, $_POST);
            header('Location: /dashboard/services');
            exit;
        }
        $service = $this->serviceModel->getServiceById($id);
        $pageTitle = "Editar Servicio";
        $contentFile = __DIR__ . '/../views/services/edit.php';
        require __DIR__ . '/../views/dashboard/layout.php';
    }

    public function delete($id) {
        $this->serviceModel->deleteService($id);
        header('Location: /dashboard/services');
        exit;
    }
}