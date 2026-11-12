<?php
require_once __DIR__ . '/../services/DocumentService.php';

// Initialize the service instance
$documentService = new DocumentService();

/**
 * @OA\Get(
 *     path="/documents",
 *     tags={"documents"},
 *     summary="Get all documents",
 *     @OA\Response(response="200", description="List of all documents")
 * )
 */
Flight::route('GET /documents', function() use ($documentService) {
    Flight::json($documentService->get_all());
});

/**
 * @OA\Get(
 *     path="/documents/{id}",
 *     tags={"documents"},
 *     summary="Get document by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Document ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Document details")
 * )
 */
Flight::route('GET /documents/@id', function($id) use ($documentService) {
    Flight::json($documentService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/documents",
 *     tags={"documents"},
 *     summary="Create a new document",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "file_name", "file_path"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="file_name", type="string", example="security_report.pdf"),
 *             @OA\Property(property="file_path", type="string", example="/uploads/documents/security_report.pdf")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Document created successfully")
 * )
 */
Flight::route('POST /documents', function() use ($documentService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $documentService->create($data);
        Flight::json(['message' => 'Document created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Put(
 *     path="/documents/{id}",
 *     tags={"documents"},
 *     summary="Update an existing document",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Document ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"file_name", "file_path"},
 *             @OA\Property(property="file_name", type="string", example="updated_report.pdf"),
 *             @OA\Property(property="file_path", type="string", example="/uploads/documents/updated_report.pdf")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Document updated successfully")
 * )
 */
Flight::route('PUT /documents/@id', function($id) use ($documentService) {
    $data = Flight::request()->data->getData();
    try {
        $documentService->update($id, $data);
        Flight::json(['message' => 'Document updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Delete(
 *     path="/documents/{id}",
 *     tags={"documents"},
 *     summary="Delete a document",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Document ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Document deleted successfully")
 * )
 */
Flight::route('DELETE /documents/@id', function($id) use ($documentService) {
    try {
        $documentService->delete($id);
        Flight::json(['message' => 'Document deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});