<?php

namespace App\Traits;

use App\Mail\NewUserRegisteredMail;
use App\Mail\OrderShipped;
use App\Models\RolePermissionModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait RolePermissionTrait
{
    public function permissionPages()
    {

        $role = Auth::user()->role;
        if ($role != 0) {
            $role_permissions = RolePermissionModel::join('permissions', 'permissions.id', '=', 'role_permission.permission_id')->where('role_id', $role)->get();

            // print_r($permissions);
            foreach ($role_permissions as $p) {

                $permissions[] = $p->permission;
               
            }

            // print_r($permissions);
            return $permissions;
        }
    }

    public function new_user(){
        $user_id=Auth::user()->id;
        $role=Auth::user()->role;
        if($role==0){
            $SuperAdmin=User::where('role','1')->get();
            // print_r($SuperAdmin);
            foreach($SuperAdmin as $admin){

                echo $AdminEmail=$admin->email;
            }

            $data['user'] =User::find($user_id);


            Mail::to($AdminEmail)->send(new NewUserRegisteredMail([
                'name' =>Auth::user()->name,
                'email'=>Auth::user()->email
            ]));
            return view('backend/new_registered_user_mail', $data);

        }
    }
}
