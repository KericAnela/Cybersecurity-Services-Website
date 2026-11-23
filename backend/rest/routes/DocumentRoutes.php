<?php
require_once __DIR__ . '/../services/DocumentService.php';

// Initialize the service instance
$documentService = new DocumentService();

Flight::route('GET /documents', function() use ($documentService) {
    Flight::json($documentService->get_all());
});

Flight::route('GET /documents/@id', function($id) use ($documentService) {
    Flight::json($documentService->get_by_id($id));
});

Flight::route('POST /documents', function() use ($documentService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $documentService->create($data);
        Flight::json(['message' => 'Document created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('PUT /documents/@id', function($id) use ($documentService) {
    $data = Flight::request()->data->getData();
    try {
        $documentService->update($id, $data);
        Flight::json(['message' => 'Document updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('DELETE /documents/@id', function($id) use ($documentService) {
    try {
        $documentService->delete($id);
        Flight::json(['message' => 'Document deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});