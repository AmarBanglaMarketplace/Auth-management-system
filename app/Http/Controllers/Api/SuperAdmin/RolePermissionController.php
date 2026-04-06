<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\DeliveryBoy;
use App\Models\ShopAdmin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @group Roles & Permissions
 *
 * APIs for managing roles and permissions. Only accessible by Super Admin.
 */
class RolePermissionController extends Controller
{
    /**
     * Get all roles by guard name.
     *
     * This endpoint returns all role names for a given guard.
     * Example: /admins/roles?guard_name=customer
     *
     * @queryParam guard_name string required The guard name to filter roles (e.g. "customer", "agent").
     * @response 200 {
     *   "status": "success",
     *   "message": "Roles fetched",
     *   "code": 200,
     *   "data": ["customer"]
     * }
     */
    public function getRolesByGuard(Request $request)
    {
        $request->validate([
            'guard_name' => 'required|string|in:user,shop-admin,agent,delivery-boy,customer,super-admin'
        ]);
        try {
            $guard = $request->query('guard_name');
            if (!$guard) {
                return ApiResponse::error('guard_name query missing', 400);
            }
            $roles = Role::where('guard_name', $guard)->pluck('name');
            return ApiResponse::success('Roles fetched', 200, $roles);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Get all roles.
     *
     * Returns all roles with their IDs.
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "Roles fetched",
     *   "code": 200,
     *   "data": [{"id":1,"name":"super-admin"}]
     * }
     */
    public function getRoles()
    {
        try {
            $roles = Role::all(['name', 'id']);
            return ApiResponse::success('Roles fetched', 200, $roles);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Get all permissions by role.
     *
     * Returns all permissions assigned to a specific role.
     *
     * @urlParam role string required The role (e.g. "customer").
     * @response 200 {
     *   "status": "success",
     *   "message": "Permissions fetched",
     *   "code": 200,
     *   "data": ["place-order","view-dashboard"]
     * }
     */
    public function getPermissionsByRole(Role $role)
    {
        try {
            $permissions = $role->permissions;
            return ApiResponse::success('Permissions fetched', 200, $permissions);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Create a new role
     *
     * This endpoint allows you to create a new role in the system.
     *
     * 🔑 Parameters
     * - @bodyParam name string required The name of the role. Must be unique.
     * - @bodyParam guard_name string required The guard name. 
     *   Allowed values: "user", "shop-admin", "agent", "delivery-boy", "customer", "super-admin".
     *
     * 📦 Example Request
     * POST /api/admins/roles
     * {
     *   "name": "shop-manager",
     *   "guard_name": "shop-admin"
     * }
     *
     * ✅ Example Response (201 Created)
     * {
     *   "status": "success",
     *   "message": "Role created",
     *   "code": 201,
     *   "data": {
     *     "id": 2,
     *     "name": "shop-manager",
     *     "guard_name": "shop-admin",
     *     "created_at": "2026-04-06T12:45:00",
     *     "updated_at": "2026-04-06T12:45:00"
     *   }
     * }
     */
    public function createRole(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|unique:roles,name',
            'guard_name' => 'required|string|in:user,shop-admin,agent,delivery-boy,customer,super-admin'
        ]);
        try {
            $role = Role::create($request->only('name', 'guard_name'));
            return ApiResponse::success('Role created', 201, $role);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Delete a role entirely.
     *
     * Removes the role record from the database.
     *
     * @urlParam role int required The role ID.
     * @response 200 {
     *   "status": "success",
     *   "message": "Role deleted",
     *   "code": 200
     * }
     */
    public function deleteRole(Role $role)
    {
        try {
            $role->delete();
            return ApiResponse::success('Role deleted', 200);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Get all permissions.
     *
     * Returns a list of all permissions in the system.
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "Permissions fetched",
     *   "code": 200,
     *   "data": [
     *     {"id":1,"name":"upload-image","guard_name":"agent"},
     *     {"id":2,"name":"delete-image","guard_name":"agent"}
     *   ]
     * }
     */
    public function getPermissions()
    {
        try {
            $permissions = Permission::all(['id', 'name', 'guard_name']);
            return ApiResponse::success('Permissions fetched', 200, $permissions);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Create a new permission
     *
     * This endpoint allows you to define a new permission for a specific guard.
     *
     * 📥 Request Parameters
     * - @bodyParam name string required The name of the permission. Must be unique.
     * - @bodyParam guard_name string required The guard name. 
     *   Allowed values: "user", "shop-admin", "agent", "delivery-boy", "customer", "super-admin".
     *
     * 📦 Example Request
     * POST /api/admins/permissions
     * {
     *   "name": "upload-image",
     *   "guard_name": "agent"
     * }
     *
     * ✅ Example Response (201 Created)
     * {
     *   "status": "success",
     *   "message": "Permission created",
     *   "code": 201,
     *   "data": {
     *     "id": 5,
     *     "name": "upload-image",
     *     "guard_name": "agent",
     *     "created_at": "2026-04-06T12:50:00",
     *     "updated_at": "2026-04-06T12:50:00"
     *   }
     * }
     */
    public function createPermission(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|unique:permissions,name',
            'guard_name' => 'required|string|in:user,shop-admin,agent,delivery-boy,customer,super-admin'
        ]);
        try {
            $permission = Permission::create($request->only('name', 'guard_name'));
            return ApiResponse::success('Permission created', 201, $permission);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Delete a permission entirely.
     *
     * Removes the permission record from the database.
     *
     * @urlParam permission int required The permission ID.
     * @response 200 {
     *   "status": "success",
     *   "message": "Permission deleted",
     *   "code": 200
     * }
     */
    public function deletePermission(Permission $permission)
    {
        try {
            $permission->delete();
            return ApiResponse::success('Permission deleted', 200);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Assign permissions to a role
     *
     * This endpoint allows you to grant one or more permissions to a specific role.
     *
     * @urlParam role int required The role ID.
     * @bodyParam permissions array required List of permission names to assign.
     *   Each item must be a valid permission name existing in the system.
     *
     * 📦 Example Request
     * POST /api/admins/roles/6/permissions
     * {
     *   "permissions": ["upload-image","delete-image"]
     * }
     *
     * ✅ Example Response (200 OK)
     * {
     *   "status": "success",
     *   "message": "Permissions assigned",
     *   "code": 200,
     *   "data": ["upload-image","delete-image"]
     * }
     */

    public function assignPermissionToRole(Request $request, Role $role)
    {
        $request->validate([
            'permissions'   => 'required|string',
        ]);
        try {
            $role->givePermissionTo($request->permissions);
            return ApiResponse::success('Permissions assigned', 200, $role->permissions);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Sync permissions for a role.
     *
     * This endpoint will replace the role's current permissions with the provided list.
     * Any permissions not in the list will be removed, and new ones will be added.
     *
     * @urlParam role int required The role ID.
     * @bodyParam permissions array required List of permission names to assign to the role.
     * @response 200 {
     *   "status": "success",
     *   "message": "Permissions updated",
     *   "code": 200,
     *   "data": ["upload-image","delete-image"]
     * }
     */
    public function syncPermissionsForRole(Request $request, Role $role)
    {
        $request->validate([
            'permissions'   => 'required|array',
            'permissions.*' => 'string|exists:permissions,name'
        ]);
        try {
            $permissions = $request->permissions;
            $role->syncPermissions($permissions);

            return ApiResponse::success('Permissions updated', 200, $role->permissions->pluck('name'));
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Remove a permission from a role.
     *
     * Detaches a specific permission from the given role without deleting the permission itself.
     *
     * @urlParam role int required The role ID.
     * @bodyParam permission string required The permission name to remove.
     * @response 200 {
     *   "status": "success",
     *   "message": "Permission removed from role",
     *   "code": 200,
     *   "data": []
     * }
     */
    public function removePermissionFromRole(Request $request, Role $role)
    {
        $request->validate([
            'permission' => 'required|string|exists:permissions,name'
        ]);

        try {
            $role->revokePermissionTo($request->permission);
            return ApiResponse::success('Permission removed from role', 200, $role->permissions);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Assign roles to a user
     *
     * This endpoint allows you to assign one or more roles to a specific user.
     *
     * 📥 Request Parameters
     * - @bodyParam user_type string required The type of user. Allowed values: "agent", "shop-admin", "delivery-boy", "super-admin", "customer".
     * - @bodyParam userId int required The user ID.
     * - @bodyParam roles string required The role name to assign. 
     *   If multiple roles are supported, send them as a comma-separated string.
     *
     * 📦 Example Request
     * POST /api/admins/users/12/roles
     * {
     *   "user_type": "agent",
     *   "userId": 12,
     *   "roles": "agent"
     * }
     *
     * ✅ Example Response (200 OK)
     * {
     *   "status": "success",
     *   "message": "Roles assigned",
     *   "code": 200,
     *   "data": ["agent"]
     * }
     */

    public function assignRoleToUser(Request $request)
    {
        $request->validate([
            'user_type' => 'required|string|in:agent,shop-admin,delivery-boy,super-admin',
            'roles'     => 'required|string'
        ]);

        try {
            $user_type = $request->user_type;
            $user = null;

            switch ($user_type) {
                case 'customer':
                    $user = Customer::findOrFail($request->userId);
                    break;
                case 'agent':
                    $user = Agent::findOrFail($request->userId);
                    break;
                case 'shop-admin':
                    $user = ShopAdmin::findOrFail($request->userId);
                    break;
                case 'delivery-boy':
                    $user = DeliveryBoy::findOrFail($request->userId);
                    break;
                case 'super-admin':
                    $user = User::findOrFail($request->userId);
                    break;
                default:
                    return ApiResponse::error('Invalid user type', 400);
            }

            $user->assignRole($request->roles);
            return ApiResponse::success('Roles assigned', 200, $user->getRoleNames());
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Remove a role from a user
     *
     * This endpoint allows you to remove a specific role from a given user.
     *
     * @urlParam userId int required The user ID.
     * @queryParam user_type string required The type of user. Allowed values: "agent", "shop-admin", "delivery-boy", "super-admin".
     * @queryParam role string required The role name to remove.
     *
     * 📦 Example Request
     * DELETE /api/admins/users/12/roles?user_type=agent&role=agent
     *
     * ✅ Example Response (200 OK)
     * {
     *   "status": "success",
     *   "message": "Role removed",
     *   "code": 200,
     *   "data": []
     * }
     */
    public function removeRoleFromUser(Request $request, $userId)
    {
        try {
            $user_type = $request->query('user_type');
            $user = null;
            switch ($user_type) {
                case 'agent':
                    $user = Agent::findOrFail($userId);
                    break;
                case 'shop-admin':
                    $user = ShopAdmin::findOrFail($userId);
                    break;
                case 'delivery-boy':
                    $user = DeliveryBoy::findOrFail($userId);
                    break;
                case 'super-admin':
                    $user = User::findOrFail($userId);
                    break;
                default:
                    return ApiResponse::error('Invalid user type', 400);
            }

            $user->removeRole($request->query('role'));

            return ApiResponse::success('Role removed', 200, $user->getRoleNames());
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}
