<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * API Controller for admin authentication.
 *
 * Handles admin login, profile retrieval, current user role/permissions,
 * and logout using Laravel Sanctum with Spatie permissions integration.
 */
class SuperAdminAuthenticationController extends Controller
{
    /**
     * Login Super Admin.
     *
     * Revokes all existing tokens before issuing a new one.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $admin = User::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        $admin->tokens()->delete(); // --- IGNORE ---
        $token = $admin->createToken('admin-token', ['*'])->plainTextToken;
        return ApiResponse::success('Login successful', 200, ['user' => $admin, 'token' => $token]);
    }

    /**
     * Get the authenticated Super Admin full profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Get the current authenticated Super Admin role and permissions.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $admin = $request->user();
        return response()->json([
            'role' => $admin->roles->pluck('name')->first(),
            'permissions' => $admin->getAllPermissions()->pluck('name'),
        ]);
    }
    /**
     * Validate the bearer token
     *
     * This endpoint checks if a valid Sanctum personal access token
     * is provided in the request. If the token is valid, the associated
     * user is returned; otherwise, an error response is sent.
     *
     * @param \Illuminate\Http\Request $request
     *     The incoming HTTP request containing the Authorization header.
     *
     * @return \Illuminate\Http\JsonResponse
     *     JSON response with validation status:
     *     - Success: { "valid": true, "user_id": <int> }
     *     - Error:   { "valid": false, "message": "Token missing/Invalid token" }
     *
     * @example
     * // Example request:
     * GET /api/validate-token
     * Authorization: Bearer <token>
     *
     * // Example success response:
     * {
     *   "status": 200,
     *   "message": "Validation successful",
     *   "data": {
     *     "valid": true,
     *     "user_id": 1
     *   }
     * }
     *
     * // Example error response:
     * {
     *   "status": 401,
     *   "message": "Invalid token",
     *   "data": {
     *     "valid": false
     *   }
     * }
     */
    public function validateToken(Request $request)
    {
        // Get token from Authorization header 
        $token = $request->bearerToken();
        if (! $token) {
            return ApiResponse::error('Token missing', 401, ['valid' => false]);
        }
        // If using Sanctum personal access tokens: 
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            return ApiResponse::success('Validation successful', 200, ['valid' => true, 'user_id' => $user->id]);
        }
        return ApiResponse::error('Invalid token', 401, ['valid' => false]);
    }

   /**
 * Log out the authenticated Super Admin by revoking all issued tokens.
 *
 * This endpoint deletes all active Sanctum tokens for the current Super Admin,
 * effectively invalidating any existing sessions. A successful response
 * confirms that the Super Admin has been logged out and must re‑authenticate
 * to access protected endpoints again.
 *
 * @group Authentication
 * @authenticated
 *
 * @header Authorization Bearer <token>
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 */

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ApiResponse::success('Logged out successful', 200);
    }
}
