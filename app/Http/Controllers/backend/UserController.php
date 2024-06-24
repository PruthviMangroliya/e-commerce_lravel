<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\RolesModel;
use App\Models\User;
use App\Traits\RolePermissionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use RolePermissionTrait;

    // public function validate_user_role(Request $request)
    // {
    //     $permissions = $this->permissionPages($request->path());
    //     foreach ($permissions as $permission) {
    //         // echo $request->is($permission . '*');
    //         if ($permission != "All") {
    //             if ($request->is($permission . '*')) {
    //                 echo "jhj";
    //             } else {
    //                 abort(404, "You don'nt have permission to this page");
    //             }
    //         }
    //     }
    // }

    // public function __construct(Request $request)
    // {
        
    //     $permissions = $this->permissionPages($request->path());
    //     foreach ($permissions as $permission) {
    //         // echo $request->is($permission . '*');
    //         if ($permission != "All") {
    //             if ($request->is($permission . '*')) {
    //                 echo "jhj";
    //             } else {
    //                 abort(404, "You don'nt have permission to this page");
    //             }
    //         }
    //     }
        
    // }

    public function get_user(Request $request)
    {
        // if (!$_POST) {

            $data['users'] = User::all();
            // $data['users'] = User::join('roles','roles.id','=','users.role')->get();
            $data['roles'] = RolesModel::all();

            // Just the path part of the URL
            // $request->path();

            return view('backend.users.user_list', $data);
        // }
    }

    public function change_role(Request $request)
    {
        // echo $request->user_role;
        User::where('id', $request->user_id)->update([
            'role' => $request->user_role
        ]);
        return redirect('users');
    }
}
