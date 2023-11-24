<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/v1/auth/sign-in",
     *      operationId="postSignInUser",
     *      tags={"Authentication"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *            @OA\Property(
     *              property="token",
     *              type="string",
     *              example="oqh12894nnlas******",
     *            ),
     *          )
     *      ),
     *      @OA\RequestBody(
     *          request="UserStoreRequestBody",
     *          description="Post new user object to the system",
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  type="string",
     *                  description="user email",
     *                  property="email"
     *              ),
     *              @OA\Property(
     *                  type="string",
     *                  description="user password",
     *                  property="password"
     *              )
     *          )
     *       )
     * )
     */
    public function signIn(SignInRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $token = $user->createToken('signature-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/auth/sign-out",
     *      operationId="postSignOutUser",
     *      tags={"Authentication"},
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\Property(
     *            title="title",
     *            description="description",
     *            example="example"
     *          )
     *      )
     * )
     */
    public function signOut(Request $request)
    {
        return Auth::guard('sanctum')?->user();
        // try {
        //     $tokens = $request?->user()?->tokens ? $request?->user()?->tokens : [];
        //     foreach ($tokens as $token) {
        //         $token->delete();
        //     }
        // } finally {
        //     return response()->json([
        //         'message' => 'logout success'
        //     ]);
        // }
    }
}
