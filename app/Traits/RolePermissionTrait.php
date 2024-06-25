<?php

namespace App\Traits;

use App\Mail\NewUserRegisteredMail;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\User;
use App\Models\UserDisabledPermissionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait RolePermissionTrait
{
    public function permissionPages()
    {

        $role = Auth::user()->role;
        $user_id = Auth::user()->id;
        if ($role != 0) {
            $role_permissions = RolePermissionModel::join('permissions', 'permissions.id', '=', 'role_permission.permission_id')->where('role_id', $role)->get();

            // print_r($permissions);
            foreach ($role_permissions as $p) {

                $permissions[] = $p->permission;
            }

            $get_removed_permission_ids = UserDisabledPermissionModel::where('user_id', $user_id)->get();

            $removed_permission_ids = array();
            foreach ($get_removed_permission_ids as $removed) {
                $removed_permission_ids[] = $removed->permission_id;
            }

            if (!empty($removed_permission_ids)) {
                $get_removed_permissions = PermissionModel::whereIN('id', $removed_permission_ids)->get();

                foreach ($get_removed_permissions as $removed) {
                    $removed_permissions[] = $removed->permission;
                }

                if (!empty($removed_permissions)) {
                    foreach ($removed_permissions as $key => $removable_permission) {
                        if (in_array($removable_permission, $permissions)) {
                            $removable_key = array_search($removable_permission, $permissions);
                            unset($permissions[$removable_key]);
                        }
                    }
                }
            }
            
            return $permissions;
        }
    }

    public function new_user()
    {
        $user_id = Auth::user()->id;
        $role = Auth::user()->role;
        if ($role == 0) {
            $SuperAdmin = User::where('role', '1')->get();
            // print_r($SuperAdmin);
            foreach ($SuperAdmin as $admin) {

                echo $AdminEmail = $admin->email;
            }

            $data['user'] = User::find($user_id);


            Mail::to($AdminEmail)->send(new NewUserRegisteredMail([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ]));
            return view('backend/new_registered_user_mail', $data);
        }
    }
}
