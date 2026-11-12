<?php
require_once __DIR__ . '/../services/ServiceService.php';

// Initialize the service instance
$serviceService = new ServiceService();

/**
 * @OA\Get(
 *     path="/services",
 *     tags={"services"},
 *     summary="Get all services",
 *     @OA\Response(response="200", description="List of all services")
 * )
 */
Flight::route('GET /services', function() use ($serviceService) {
    Flight::json($serviceService->get_all());
});

/**
 * @OA\Get(
 *     path="/services/{id}",
 *     tags={"services"},
 *     summary="Get service by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Service ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Service details")
 * )
 */
Flight::route('GET /services/@id', function($id) use ($serviceService) {
    Flight::json($serviceService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/services",
 *     tags={"services"},
 *     summary="Create a new service",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "base_price"},
 *             @OA\Property(property="title", type="string", example="Cybersecurity Penetration Testing"),
 *             @OA\Property(property="description", type="string", example="Comprehensive vulnerability assessment."),
 *             @OA\Property(property="base_price", type="number", format="float", example=1500.00),
 *             @OA\Property(property="category", type="string", example="Assessment")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Service created successfully")
 * )
 */
Flight::route('POST /services', function() use ($serviceService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $serviceService->create($data);
        Flight::json(['message' => 'Service created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Put(
 *     path="/services/{id}",
 *     tags={"services"},
 *     summary="Update an existing service",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Service ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "base_price"},
 *             @OA\Property(property="title", type="string", example="Advanced Penetration Testing"),
 *             @OA\Property(property="description", type="string", example="Updated description."),
 *             @OA\Property(property="base_price", type="number", format="float", example=1800.00),
 *             @OA\Property(property="category", type="string", example="Assessment")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Service updated successfully")
 * )
 */
Flight::route('PUT /services/@id', function($id) use ($serviceService) {
    $data = Flight::request()->data->getData();
    try {
        $serviceService->update($id, $data);
        Flight::json(['message' => 'Service updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Delete(
 *     path="/services/{id}",
 *     tags={"services"},
 *     summary="Delete a service",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Service ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Service deleted successfully")
 * )
 */
Flight::route('DELETE /services/@id', function($id) use ($serviceService) {
    try {
        $serviceService->delete($id);
        Flight::json(['message' => 'Service deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});