<?php
require_once __DIR__ . '/../services/UpdateService.php';

// Initialize the service instance
$updateService = new UpdateService();

/**
 * @OA\Get(
 *     path="/updates",
 *     tags={"updates"},
 *     summary="Get all regulatory updates",
 *     @OA\Response(response="200", description="List of all updates")
 * )
 */
Flight::route('GET /updates', function() use ($updateService) {
    Flight::json($updateService->get_all());
});

/**
 * @OA\Get(
 *     path="/updates/{id}",
 *     tags={"updates"},
 *     summary="Get update by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Update ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Update details")
 * )
 */
Flight::route('GET /updates/@id', function($id) use ($updateService) {
    Flight::json($updateService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/updates",
 *     tags={"updates"},
 *     summary="Create a new regulatory update",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"author_id", "title", "content"},
 *             @OA\Property(property="author_id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="New Cybersecurity Compliance Guidelines 2026"),
 *             @OA\Property(property="content", type="string", example="Details regarding updated regulatory standards..."),
 *             @OA\Property(property="published_at", type="string", format="date-time", example="2026-06-01 12:00:00")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Update created successfully")
 * )
 */
Flight::route('POST /updates', function() use ($updateService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $updateService->create($data);
        Flight::json(['message' => 'Update created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Put(
 *     path="/updates/{id}",
 *     tags={"updates"},
 *     summary="Update an existing regulatory update",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Update ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "content"},
 *             @OA\Property(property="title", type="string", example="Revised Cybersecurity Compliance Guidelines"),
 *             @OA\Property(property="content", type="string", example="Updated content details..."),
 *             @OA\Property(property="published_at", type="string", format="date-time", example="2026-06-02 09:00:00")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Update updated successfully")
 * )
 */
Flight::route('PUT /updates/@id', function($id) use ($updateService) {
    $data = Flight::request()->data->getData();
    try {
        $updateService->update($id, $data);
        Flight::json(['message' => 'Update updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Delete(
 *     path="/updates/{id}",
 *     tags={"updates"},
 *     summary="Delete a regulatory update",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Update ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Update deleted successfully")
 * )
 */
Flight::route('DELETE /updates/@id', function($id) use ($updateService) {
    try {
        $updateService->delete($id);
        Flight::json(['message' => 'Update deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});