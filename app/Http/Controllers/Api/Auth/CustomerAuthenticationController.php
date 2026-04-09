<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\SmsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerAuthenticationController extends Controller
{
    /**
     * Register a new Customer user.
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
            'phone' => [
                'required',
                'string',
                'regex:/^[0-9]{10,15}$/',
                'unique:customers,phone'
            ],
            'password' => 'required|min:6|confirmed',
        ]);

        // Create user
        $user = Customer::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Issue token
        $token = $user->createToken('customers-token', ['*'])->plainTextToken;
        $expiry = now()->addHours(2);
        $user->token_expires_at = $expiry;
        $user->save();
        return ApiResponse::success('Registration successful', 201, ['user' => $user, 'token' => $token]);
    }
    /**
     * Login a Customer.
     *
     * Revokes all existing tokens before issuing a new one.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => [
                'required',
                'string',
                'regex:/^[0-9]{10,15}$/',
            ],
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);
        $admin = Customer::where('phone', $request->phone)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        $admin->tokens()->delete(); // --- IGNORE ---

        $token = $admin->createToken('customers-token', ['*'])->plainTextToken;

        $expiry = $request->remember_me ? now()->addDays(30) : now()->addHours(2);
        $admin->token_expires_at = $expiry;
        $admin->save();

        return ApiResponse::success('Login successful', 200, ['user' => $admin, 'token' => $token]);
    }
    /**
     * Update the authenticated Customer's password.
     *
     * Validates the current password, ensures the new password meets
     * security requirements, and updates the stored hash. Requires
     * authentication and CSRF protection.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return ApiResponse::error('Current password is incorrect', 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return ApiResponse::success('Password updated successfully', 200);
    }
    /**
     * Validate the bearer token.
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
        $user = Auth::guard('customer')->user();

        // Check custom expiry
        $expiry = $user->token_expires_at;
        if (! $expiry || now()->greaterThan($expiry)) {
            // Token expired → revoke and reject
            $user->tokens()->delete();
            return ApiResponse::error('Token expired', 401, ['valid' => false]);
        }
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
     * Log out the authenticated Customer by revoking all issued tokens.
     *
     * This endpoint deletes all active Sanctum tokens for the current Customer,
     * effectively invalidating any existing sessions. A successful response
     * confirms that the Customer has been logged out and must re‑authenticate
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
        $user = $request->user();
        $user->token_expires_at = null;
        $user->save();
        $request->user()->tokens()->delete();
        return ApiResponse::success('Logged out successful', 200);
    }
    /**
     *Reset Password Send OTP to a customer's phone number.
     *
     * Validates the phone number, generates a random OTP, stores it in cache for 5 minutes,
     * sends the OTP via SMS, and logs the attempt.
     *
     * @param \Illuminate\Http\Request $request
     *   The HTTP request containing the customer's phone number.
     *
     * @return \Illuminate\Http\JsonResponse
     *   A JSON response indicating success or failure of OTP sending.
     *
     * @throws \Illuminate\Validation\ValidationException
     *   If the phone number validation fails.
     * @throws \Exception
     *   If an unexpected error occurs during SMS sending.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|exists:customers,phone',
        ]);
        try {

            $otp = rand(100000, 999999);

            // Store OTP temporarily (5 minutes)
            Cache::put('otp_' . $request->phone, $otp, now()->addMinutes(5));

            // Prepare message
            $message = "Your AmarBangla OTP is: " . $otp;

            // Find customer
            $customer = Customer::where('phone', $request->phone)->first();

            // Send SMS
            $sent = SmsService::send($message, $customer->phone);

            // Log OTP and SMS status
            Log::info('OTP generated', [
                'phone' => $customer->phone,
                'otp'   => $otp,
                'sms_sent' => $sent,
            ]);

            if ($sent) {
                return ApiResponse::success('OTP sent successfully', 200);
            } else {
                return ApiResponse::error('Failed to send SMS', 500);
            }
        } catch (Exception $e) {
            // Log the exception details
            Log::error('Error sending OTP', [
                'phone' => $request->phone,
                'error' => $e->getMessage(),
            ]);

            return ApiResponse::error('An unexpected error occurred while sending OTP', 500);
        }
    }
    /**
     * Validate OTP and reset customer's password.
     *
     * Checks the provided OTP against the cached value, validates the new password,
     * updates the customer's password if OTP is correct, clears the OTP from cache,
     * and logs the result.
     *
     * @param \Illuminate\Http\Request $request
     *   The HTTP request containing phone number, OTP, and new password.
     *
     * @return \Illuminate\Http\JsonResponse
     *   A JSON response indicating success or failure of password reset.
     *
     * @throws \Illuminate\Validation\ValidationException
     *   If the input validation fails.
     * @throws \Exception
     *   If an unexpected error occurs during OTP validation or password reset.
     */
    public function validateOtpAndResetPassword(Request $request)
    {
        $request->validate([
            'phone'        => 'required|string|exists:customers,phone',
            'otp'          => 'required|numeric',
            'new_password' => 'required|min:8|confirmed',
        ]);
        try {

            // Retrieve cached OTP
            $cachedOtp = Cache::get('otp_' . $request->phone);

            if (!$cachedOtp) {
                return ApiResponse::error('OTP expired or not found', 401);
            }

            if ($cachedOtp != $request->otp) {
                Log::warning('Invalid OTP attempt', [
                    'phone' => $request->phone,
                    'provided_otp' => $request->otp,
                ]);
                return ApiResponse::error('Invalid OTP', 401);
            }

            // Find customer
            $customer = Customer::where('phone', $request->phone)->first();

            if (!$customer) {
                return ApiResponse::error('Customer not found', 404);
            }

            // Reset password
            $customer->password = Hash::make($request->new_password);
            $customer->save();

            // Clear OTP after successful reset
            Cache::forget('otp_' . $request->phone);

            Log::info('Password reset successful via OTP', [
                'phone' => $customer->phone,
            ]);

            return ApiResponse::success('Password reset successfully', 200);
        } catch (Exception $e) {
            Log::error('Error validating OTP and resetting password', [
                'phone' => $request->phone,
                'error' => $e->getMessage(),
            ]);
            return ApiResponse::error('An unexpected error occurred', 500);
        }
    }
}
