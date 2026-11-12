<?php
require_once __DIR__ . '/../services/ServiceService.php';

// Initialize the service instance
$serviceService = new ServiceService();

Flight::route('GET /services', function() use ($serviceService) {
    Flight::json($serviceService->get_all());
});

Flight::route('GET /services/@id', function($id) use ($serviceService) {
    Flight::json($serviceService->get_by_id($id));
});

Flight::route('POST /services', function() use ($serviceService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $serviceService->create($data);
        Flight::json(['message' => 'Service created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('PUT /services/@id', function($id) use ($serviceService) {
    $data = Flight::request()->data->getData();
    try {
        $serviceService->update($id, $data);
        Flight::json(['message' => 'Service updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('DELETE /services/@id', function($id) use ($serviceService) {
    try {
        $serviceService->delete($id);
        Flight::json(['message' => 'Service deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});