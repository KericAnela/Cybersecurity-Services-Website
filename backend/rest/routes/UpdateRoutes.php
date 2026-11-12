<?php
require_once __DIR__ . '/../services/UpdateService.php';

// Initialize the service instance
$updateService = new UpdateService();

Flight::route('GET /updates', function() use ($updateService) {
    Flight::json($updateService->get_all());
});

Flight::route('GET /updates/@id', function($id) use ($updateService) {
    Flight::json($updateService->get_by_id($id));
});

Flight::route('POST /updates', function() use ($updateService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $updateService->create($data);
        Flight::json(['message' => 'Update created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('PUT /updates/@id', function($id) use ($updateService) {
    $data = Flight::request()->data->getData();
    try {
        $updateService->update($id, $data);
        Flight::json(['message' => 'Update updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('DELETE /updates/@id', function($id) use ($updateService) {
    try {
        $updateService->delete($id);
        Flight::json(['message' => 'Update deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});