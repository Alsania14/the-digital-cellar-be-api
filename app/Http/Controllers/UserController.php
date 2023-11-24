<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/users",
     *      operationId="getUsers",
     *      tags={"Users"},
     *      security={ {"sanctum": {} }},
     *      summary="Get Simple Pagination Laravel of data Users",
     *      description="Returns list of simple pagination Laravel Users",
     *      @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Target page, default value is one",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="per_page, default value is ten",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="global filter users, with name and email",
     *         required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *             ref="#/components/schemas/UserCollection"
     *         )
     *       ),
     *     )
     */
    public function index(Request $request)
    {
        $userQuery = User::query();
        if ($request?->input('search') != null) {
            $userQuery->orWhere('name', 'like', '%' . $request?->input('search') . '%');
            $userQuery->orWhere('email', 'like', '%' . $request?->input('search') . '%');
        }
        return new UserCollection($userQuery->simplePaginate($request?->input('per_page') ?? 10));
    }

    /**
     * @OA\Post(
     *      path="/api/v1/users",
     *      operationId="postUser",
     *      tags={"Users"},
     *      summary="Post new user",
     *      security={ {"sanctum": {} }},
     *      description="Post new user with name and email, created_at and updated_at is nullable",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *            @OA\Property(
     *              property="data",
     *              type="object",
     *              nullable="true",
     *              allOf={
     *                @OA\Schema(ref="#/components/schemas/UserResource"),
     *              },
     *            ),
     *          )
     *      ),
     *      @OA\RequestBody(
     *          request="UserStoreRequestBody",
     *          description="Post new user object to the system",
     *          required=true,
     *          @OA\JsonContent(
     *            allOf={
     *              @OA\Schema(ref="#/components/schemas/UserResource"),
     *            },
     *          )
     *       )
     * )
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        return new UserResource($user);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/{id_user}",
     *      operationId="getUser",
     *      tags={"Users"},
     *      security={ {"sanctum": {} }},
     *      summary="Get user with partial user data",
     *      description="Get with partial user data",
     *      @OA\Parameter(
     *         name="id_user",
     *         in="path",
     *         description="Target user id",
     *         required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *            @OA\Property(
     *              property="data",
     *              type="object",
     *              nullable="true",
     *              allOf={
     *                @OA\Schema(ref="#/components/schemas/UserResource"),
     *              },
     *            ),
     *          )
     *      ),
     * )
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * @OA\Patch(
     *      path="/api/v1/{id_user}",
     *      operationId="patchUser",
     *      tags={"Users"},
     *      security={ {"sanctum": {} }},
     *      summary="Patch user with partial user data",
     *      description="Patch with partial user data",
     *      @OA\Parameter(
     *         name="id_user",
     *         in="path",
     *         description="Target user id",
     *         required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *            @OA\Property(
     *              property="data",
     *              type="object",
     *              nullable="true",
     *              allOf={
     *                @OA\Schema(ref="#/components/schemas/UserResource"),
     *              },
     *            ),
     *          )
     *      ),
     *      @OA\RequestBody(
     *          request="UserUpdateRequestBody",
     *          description="Patch user object to the system",
     *          required=true,
     *          @OA\JsonContent(
     *            allOf={
     *              @OA\Schema(ref="#/components/schemas/UserResource"),
     *            },
     *          )
     *       )
     * )
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        User::findOrFail($id)->update($request->all());
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/{id_user}",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="Delete user",
     *      security={ {"sanctum": {} }},
     *      description="Permanently delete user",
     *      @OA\Parameter(
     *         name="id_user",
     *         in="path",
     *         description="Target user id",
     *         required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *            @OA\Property(
     *              property="data",
     *              type="boolean",
     *              nullable="true",
     *              example=true,
     *            ),
     *          )
     *      ),
     * )
     */
    public function destroy(string $id)
    {
        $isSuccess = User::findOrFail($id)->delete();
        return $isSuccess === 1;
    }
}
