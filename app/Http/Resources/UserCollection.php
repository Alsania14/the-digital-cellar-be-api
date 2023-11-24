<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Schema(
 *    schema="UserCollection",
 *         @OA\Property(
 *           property="data",
 *           type="object",
 *           nullable=false,
 *           description="User details",
 *           type="array",
 *           @OA\Items(
 *              type="object",
 *              ref="#/components/schemas/UserResource",
 *           ),
 *        ),
 *        @OA\Property(
 *           property="links",
 *           type="object",
 *           nullable=false,
 *           description="User details",
 *           @OA\Property(
 *             property="links",
 *             type="string",
 *             nullable=false,
 *             example="http://127.0.0.1:8000/api/v1/users?page=1",
 *           ),
 *           @OA\Property(
 *               property="last",
 *               type="string",
 *               nullable=false,
 *               example=null,
 *           ),
 *           @OA\Property(
 *               property="next",
 *               type="string",
 *               nullable=false,
 *               example=null,
 *           ),
 *           @OA\Property(
 *               property="prev",
 *               type="string",
 *               nullable=false,
 *               example=null,
 *           ),
 *        ),
 *        @OA\Property(
 *           property="meta",
 *           type="object",
 *           nullable=false,
 *           description="User details",
 *           @OA\Property(
 *             property="links",
 *             type="string",
 *             nullable=false,
 *             example="http://127.0.0.1:8000/api/v1/users?page=1",
 *           ),
 *           @OA\Property(
 *               property="current_page",
 *               type="number",
 *               nullable=false,
 *               example=1,
 *           ),
 *           @OA\Property(
 *               property="from",
 *               type="number",
 *               nullable=false,
 *               example=1,
 *           ),
 *           @OA\Property(
 *               property="path",
 *               type="string",
 *               nullable=false,
 *               example="http://127.0.0.1:8000/api/v1/users",
 *           ),
 *           @OA\Property(
 *               property="per_page",
 *               type="number",
 *               nullable=false,
 *               example=10,
 *           ),
 *            @OA\Property(
 *               property="to",
 *               type="number",
 *               nullable=false,
 *               example=2,
 *           ),
 *      )
 * )
 */
class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
