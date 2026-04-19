<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\DeliveryBoy;
use App\Models\Seller;
use App\Models\ShopAdmin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserManagementController extends Controller
{
    /**
     * Update a Shop Admin's password by Super Admin.
     *
     * Validates the new password, hashes it, and updates the record.
     * Accessible only to authenticated Super Admins.
     *
     * @param Request $request
     * @param ShopAdmin $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateShopAdminPassword(Request $request, ShopAdmin $user)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        try {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return ApiResponse::success('Shop Admin password updated successfully', 200);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update password: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update an Agent's password by Super Admin.
     *
     * Validates and updates the password securely.
     *
     * @param Request $request
     * @param Agent $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAgentPassword(Request $request, Agent $user)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        try {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return ApiResponse::success('Agent password updated successfully', 200);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update password: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update a Delivery Boy's password by Super Admin.
     *
     * Ensures the new password meets requirements and saves securely.
     *
     * @param Request $request
     * @param DeliveryBoy $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDeliveryBoyPassword(Request $request, DeliveryBoy $user)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        try {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return ApiResponse::success('Delivery Boy password updated successfully', 200);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update password: ' . $e->getMessage(), 500);
        }
    }
    /**
     * Update a Seller's password by Super Admin.
     *
     * Ensures the new password meets requirements and saves securely.
     *
     * @param Request $request
     * @param Seller $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSellerPassword(Request $request, Seller $user)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        try {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return ApiResponse::success('Seller password updated successfully', 200);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update password: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update a Customer's password by Super Admin.
     *
     * Validates and updates the password securely.
     *
     * @param Request $request
     * @param Customer $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCustomerPassword(Request $request, Customer $user)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        try {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return ApiResponse::success('Customer password updated successfully', 200);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update password: ' . $e->getMessage(), 500);
        }
    }
}
