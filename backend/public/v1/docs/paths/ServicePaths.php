<?php

/**
 * @OA\PathItem(
 *     path="/services"
 * )
 */

class ServicePaths {

    /**
     * @OA\Get(
     *     path="/services",
     *     tags={"services"},
     *     summary="Get all services",
     *     @OA\Response(response="200", description="List of all services")
     * )
     */
    public function get_services() {}

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
    public function get_service_by_id() {}

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
    public function create_service() {}

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
    public function update_service() {}

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
    public function delete_service() {}
}