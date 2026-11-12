<?php

/**
 * @OA\PathItem(
 *     path="/documents"
 * )
 */

class DocumentPaths {

    /**
     * @OA\Get(
     *     path="/documents",
     *     tags={"documents"},
     *     summary="Get all documents",
     *     @OA\Response(response="200", description="List of all documents")
     * )
     */
    public function get_documents() {}

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
    public function get_document_by_id() {}

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
    public function create_document() {}

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
    public function update_document() {}

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
    public function delete_document() {}
}