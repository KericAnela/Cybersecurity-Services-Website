<?php
require_once __DIR__ . '/../services/ConsultationService.php';

// Initialize the service instance
$consultationService = new ConsultationService();

Flight::route('GET /consultations', function() use ($consultationService) {
    Flight::json($consultationService->get_all());
});

Flight::route('GET /consultations/@id', function($id) use ($consultationService) {
    Flight::json($consultationService->get_by_id($id));
});

Flight::route('POST /consultations', function() use ($consultationService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $consultationService->create($data);
        Flight::json(['message' => 'Consultation created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('PUT /consultations/@id', function($id) use ($consultationService) {
    $data = Flight::request()->data->getData();
    try {
        $consultationService->update($id, $data);
        Flight::json(['message' => 'Consultation updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('DELETE /consultations/@id', function($id) use ($consultationService) {
    try {
        $consultationService->delete($id);
        Flight::json(['message' => 'Consultation deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});