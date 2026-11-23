<?php
require_once __DIR__ . '/../services/UserService.php';

// Initialize the service instance
$userService = new UserService();

Flight::route('GET /users', function() use ($userService) {
    Flight::json($userService->get_all());
});

Flight::route('GET /users/@id', function($id) use ($userService) {
    Flight::json($userService->get_by_id($id));
});

Flight::route('POST /users', function() use ($userService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $userService->create($data);
        Flight::json(['message' => 'User created successfully', 'data' => $result]);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('PUT /users/@id', function($id) use ($userService) {
    $data = Flight::request()->data->getData();
    try {
        $userService->update($id, $data);
        Flight::json(['message' => 'User updated successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});

Flight::route('DELETE /users/@id', function($id) use ($userService) {
    try {
        $userService->delete($id);
        Flight::json(['message' => 'User deleted successfully']);
    } catch (Exception $e) {
        Flight::halt(400, $e->getMessage());
    }
});