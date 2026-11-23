<?php

/**
 * @OA\PathItem(
 *     path="/users"
 * )
 */

class UserPaths {

    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"users"},
     *     summary="Get all users",
     *     @OA\Response(response="200", description="List of all users")
     * )
     */
    public function get_users() {}

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
    public function get_user_by_id() {}

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
    public function create_user() {}

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
    public function update_user() {}

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
    public function delete_user() {}
}