<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *    schema="UserResource",
 *        @OA\Property(
 *            property="id",
 *            description="user unique id / primary key",
 *            type="number",
 *            nullable="false",
 *            example=1,
 *        ),
 *        @OA\Property(
 *            property="name",
 *            description="User name",
 *            type="string",
 *            nullable="false",
 *            example="Kellen Boyer"
 *        ),
 *        @OA\Property(
 *            property="email",
 *            description="User E-mail",
 *            type="string",
 *            nullable="false",
 *            example="kellen.boyer@example.com"
 *        ),
 *        @OA\Property(
 *            property="created_at",
 *            description="User created at",
 *            type="string",
 *            nullable="false",
 *            example="2023-11-24T01:10:37.000000Z"
 *        ),
 *        @OA\Property(
 *            property="updated_at",
 *            description="User updated at",
 *            type="string",
 *            nullable="false",
 *            example="2023-11-24T01:10:37.000000Z"
 *        ),
 *    )
 * )
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
