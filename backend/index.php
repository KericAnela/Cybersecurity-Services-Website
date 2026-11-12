<?php
require __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/rest/services/ConsultationService.php';
require_once __DIR__ . '/rest/services/DocumentService.php';
require_once __DIR__ . '/rest/services/ServiceService.php';
require_once __DIR__ . '/rest/services/UpdateService.php';
require_once __DIR__ . '/rest/services/UserService.php';

Flight::register('consultation_service', 'ConsultationService');
Flight::register('document_service', 'DocumentService');
Flight::register('service_service', 'ServiceService');
Flight::register('update_service', 'UpdateService');
Flight::register('user_service', 'UserService');

Flight::route('GET /', function () {
    Flight::json(['app' => 'CyberGuard', 'message' => 'The backend is running.']);
});

require_once __DIR__ . '/rest/routes/ConsultationRoutes.php';
require_once __DIR__ . '/rest/routes/DocumentRoutes.php';
require_once __DIR__ . '/rest/routes/ServiceRoutes.php';
require_once __DIR__ . '/rest/routes/UpdateRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php';

Flight::start();