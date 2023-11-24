<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/users",
     *      operationId="getUsersList",
     *      tags={"Users"},
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
     * *    @OA\Parameter(
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
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id)->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id)->delete();
        return new UserResource($user);
    }
}
