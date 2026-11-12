<?php

/**
 * @OA\PathItem(
 *     path="/updates"
 * )
 */

class UpdatePaths {

    /**
     * @OA\Get(
     *     path="/updates",
     *     tags={"updates"},
     *     summary="Get all regulatory updates",
     *     @OA\Response(response="200", description="List of all updates")
     * )
     */
    public function get_updates() {}

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
    public function get_update_by_id() {}

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
    public function create_update() {}

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
    public function update_update() {}

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
    public function delete_update() {}
}