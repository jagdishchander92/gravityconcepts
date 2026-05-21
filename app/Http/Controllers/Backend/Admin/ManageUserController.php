<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageUserController extends Controller
{

    public function userIndex()
    {
        $data['users'] = User::paginate(25);
        return view('backend.admin.users.user-index', $data);
    }

    public function createUser()
    {
        $data['user'] = null;
        $data['roles'] = Role::all();
        return view('backend.admin.users.create-user', $data);
    }



    public function storeUpdate(Request $request, $id = null)
    {
        $user = $id ? User::findOrFail($id) : new User();


        $request->validate([
            'name' => 'required',

            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore($id),
            ],
            'role_id' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => $id
                ? 'nullable|confirmed|min:6'
                : 'required|confirmed|min:6',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        $role_name = Role::findById($request->role_id);
        $user->syncRoles($role_name->name);
        return redirect('backend/admin/users')->with('success', $id ? 'User Updated Successfully!' : 'User Created Successfully!');
    }

    public function editUser($id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = Role::all();
        return view('backend.admin.users.create-user', $data);
    }

    public function userDelete($id)
    {
        User::where('id', $id)->delete();
        return redirect('backend/admin/users')->with('success', 'User Deleted Successfully!');
    }

    public function rolesIndex()
    {

        $data['roles'] = Role::all();

        return view('backend.admin.roles.role-index', $data);
    }
    public function roleCreate()
    {
        $data['role'] = null;
        return view('backend.admin.roles.create-role', $data);
    }
    public function editRole($id)
    {
        $data['role'] = Role::where('id', $id)->first();
        return view('backend.admin.roles.create-role', $data);
    }
    public function roleStoreUpdate(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        // This will update the role if $id exists, otherwise it creates a new one
        $role = Role::updateOrCreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'guard_name' => 'web'
            ]
        );

        // Optional: Sync permissions if you are passing them in the request
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect('backend/admin/roles')->with('success', 'Role saved successfully!');
    }
    public function roleDelete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('backend/admin/roles')->with('success', 'Role deleted successfully!');
    }


    public function permIndex()
    {
        // Fetch all permissions to display in a list
        $permissions = Permission::all();
        return view('backend.admin.permissions.perm-index', compact('permissions'));
    }

    public function permCreate()
    {
        // Return the view to create a new permission
        $data['permission'] = null;
        return view('backend.admin.permissions.create-perm', $data);
    }

    public function editPerm($id)
    {
        // Find the permission or fail with a 404
        $data['permission']  = Permission::findOrFail($id);
        return view('backend.admin.permissions.create-perm', $data);
    }

    public function permStoreUpdate(Request $request, $id = null)
    {
        // Validate: name must be unique except for the current record during update
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        // Create if $id is null, Update if $id is provided
        Permission::updateOrCreate(
            ['id' => $id],
            [
                'name' => $request->name,
                'guard_name' => 'web'
            ]
        );

        $message = $id ? 'Permission updated successfully.' : 'Permission created successfully.';
        return redirect()->route('admin.perm-index')->with('success', $message);
    }

    public function permDelete($id)
    {
        $permission = Permission::findOrFail($id);

        // Spatie handles the removal from roles automatically
        $permission->delete();

        return redirect()->route('admin.perm-index')->with('success', 'Permission deleted successfully.');
    }

    public function rolePermission($id)
    {
        $role = Role::findOrFail($id);
        // Note: I suggest adding a 'module' attribute to your permissions table 
        // or parsing it from the name (e.g., "user-create" belongs to "user")
        $permissions = Permission::all();

        return view('backend.admin.roles.role-permissions', compact('role', 'permissions'));
    }

    public function updateRolePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Spatie's syncPermissions handles adding and removing in one go
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }
}
