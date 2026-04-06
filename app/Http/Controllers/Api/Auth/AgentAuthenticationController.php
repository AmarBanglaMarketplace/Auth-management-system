<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentAuthenticationController extends Controller
{
    /**
     * Register a new Agent.
     *
     * This endpoint validates the incoming request data, creates a new
     * Agent record, and issues a Sanctum personal access token for API
     * authentication.
     *
     * @param \Illuminate\Http\Request $request
     *     The HTTP request containing registration details:
     *     - name: required|string|max:255
     *     - email: required|email|unique:agents,email
     *     - password: required|min:6|confirmed
     *
     * @return \Illuminate\Http\JsonResponse
     *     JSON response with registration status:
     *     - Success: { "user": { ... }, "token": "<string>" }
     *     - Error:   Validation errors with appropriate messages
     *
     * @example
     * // Example request:
     * POST /api/register
     * {
     *   "name": "Rahim Uddin",
     *   "email": "rahim@example.com",
     *   "password": "secret123",
     *   "password_confirmation": "secret123"
     * }
     *
     * // Example success response:
     * {
     *   "status": 201,
     *   "message": "Registration successful",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "Rahim Uddin",
     *       "email": "rahim@example.com"
     *     },
     *     "token": "1|XyzAbc123..."
     *   }
     * }
     *
     * // Example error response:
     * {
     *   "status": 422,
     *   "message": "Validation error",
     *   "errors": {
     *     "email": ["The email has already been taken."]
     *   }
     * }
     */
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:agents,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create user
        $user = Agent::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Issue token
        $token = $user->createToken('agents-token', ['*'])->plainTextToken;

        return ApiResponse::success('Registration successful', 201, ['user' => $user, 'token' => $token]);
    }
    /**
     * Login a Agent.
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
        $admin = Agent::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        $admin->tokens()->delete(); // --- IGNORE ---

        $token = $admin->createToken('agents-token', ['*'])->plainTextToken;
        $admin->assignRole('agent');
        return ApiResponse::success('Login successful', 200, ['user' => $admin, 'token' => $token]);
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
        $user = Auth::guard('agent')->user();
        if ($user) {
            return ApiResponse::success('Validation successful', 200, [
                'valid' => true,
                'user_id' => $user->id,
                'roles' => $user->getRoleNames(),
                'permissions' => $user->getAllPermissions()->pluck('name')
            ]);
        }
        return ApiResponse::error('Invalid token', 401, ['valid' => false]);
    }

    /**
     * Log out the authenticated Agent by revoking all issued tokens.
     *
     * This endpoint deletes all active Sanctum tokens for the current Agent,
     * effectively invalidating any existing sessions. A successful response
     * confirms that the Agent has been logged out and must re‑authenticate
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
