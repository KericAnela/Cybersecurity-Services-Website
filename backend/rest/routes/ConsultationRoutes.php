<?php
require_once __DIR__ . '/../services/ConsultationService.php';

// Initialize the service instance
$consultationService = new ConsultationService();

/**
 * @OA\Get(
 *     path="/consultations",
 *     tags={"consultations"},
 *     summary="Get all consultations",
 *     @OA\Response(response="200", description="List of all consultations")
 * )
 */
Flight::route('GET /consultations', function() use ($consultationService) {
    Flight::json($consultationService->get_all());
});

/**
 * @OA\Get(
 *     path="/consultations/{id}",
 *     tags={"consultations"},
 *     summary="Get consultation by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Consultation ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Consultation details")
 * )
 */
Flight::route('GET /consultations/@id', function($id) use ($consultationService) {
    Flight::json($consultationService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/consultations",
 *     tags={"consultations"},
 *     summary="Create a new consultation",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "service_id", "scheduled_date"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="service_id", type="integer", example=2),
 *             @OA\Property(property="status", type="string", example="Pending"),
 *             @OA\Property(property="scheduled_date", type="string", format="date-time", example="2026-06-01 10:00:00"),
 *             @OA\Property(property="notes", type="string", example="Initial security assessment discussion.")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Consultation created successfully")
 * )
 */
Flight::route('POST /consultations', function() use ($consultationService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $consultationService->create($data);
        Flight::json(['message' => 'Consultation created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Put(
 *     path="/consultations/{id}",
 *     tags={"consultations"},
 *     summary="Update an existing consultation",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Consultation ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"service_id", "status", "scheduled_date"},
 *             @OA\Property(property="service_id", type="integer", example=2),
 *             @OA\Property(property="status", type="string", example="Confirmed"),
 *             @OA\Property(property="scheduled_date", type="string", format="date-time", example="2026-06-01 10:00:00"),
 *             @OA\Property(property="notes", type="string", example="Updated notes.")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Consultation updated successfully")
 * )
 */
Flight::route('PUT /consultations/@id', function($id) use ($consultationService) {
    $data = Flight::request()->data->getData();
    try {
        $consultationService->update($id, $data);
        Flight::json(['message' => 'Consultation updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Delete(
 *     path="/consultations/{id}",
 *     tags={"consultations"},
 *     summary="Delete a consultation",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Consultation ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Consultation deleted successfully")
 * )
 */
Flight::route('DELETE /consultations/@id', function($id) use ($consultationService) {
    try {
        $consultationService->delete($id);
        Flight::json(['message' => 'Consultation deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});