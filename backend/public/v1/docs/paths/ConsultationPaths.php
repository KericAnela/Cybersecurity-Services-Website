<?php

/**
 * @OA\PathItem(
 *     path="/consultations"
 * )
 */

class ConsultationPaths {

    /**
     * @OA\Get(
     *     path="/consultations",
     *     tags={"consultations"},
     *     summary="Get all consultations",
     *     @OA\Response(response="200", description="List of all consultations")
     * )
     */
    public function get_consultations() {}

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
    public function get_consultation_by_id() {}

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
    public function create_consultation() {}

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
    public function update_consultation() {}

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
    public function delete_consultation() {}
}