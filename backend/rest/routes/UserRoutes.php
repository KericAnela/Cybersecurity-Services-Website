<?php
require_once __DIR__ . '/../services/UserService.php';

// Initialize the service instance
$userService = new UserService();

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Get all users",
 *     @OA\Response(response="200", description="List of all users")
 * )
 */
Flight::route('GET /users', function() use ($userService) {
    Flight::json($userService->get_all());
});

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="User details")
 * )
 */
Flight::route('GET /users/@id', function($id) use ($userService) {
    Flight::json($userService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/users",
 *     tags={"users"},
 *     summary="Create a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"full_name", "email", "username", "account_type", "password"},
 *             @OA\Property(property="full_name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="account_type", type="string", example="Client"),
 *             @OA\Property(property="password", type="string", format="password", example="securePassword123")
 *         )
 *     ),
 *     @OA\Response(response="200", description="User created successfully")
 * )
 */
Flight::route('POST /users', function() use ($userService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $userService->create($data);
        Flight::json(['message' => 'User created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Update an existing user",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"full_name", "email", "account_type"},
 *             @OA\Property(property="full_name", type="string", example="John Updated"),
 *             @OA\Property(property="email", type="string", format="email", example="john.updated@example.com"),
 *             @OA\Property(property="account_type", type="string", example="Client")
 *         )
 *     ),
 *     @OA\Response(response="200", description="User updated successfully")
 * )
 */
Flight::route('PUT /users/@id', function($id) use ($userService) {
    $data = Flight::request()->data->getData();
    try {
        $userService->update($id, $data);
        Flight::json(['message' => 'User updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Delete a user",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="User deleted successfully")
 * )
 */
Flight::route('DELETE /users/@id', function($id) use ($userService) {
    try {
        $userService->delete($id);
        Flight::json(['message' => 'User deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});