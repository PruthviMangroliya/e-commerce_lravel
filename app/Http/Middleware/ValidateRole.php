<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\RolePermissionTrait;

class ValidateRole
{
    use RolePermissionTrait;


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissions = $this->permissionPages();

        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                // echo $request->is($permission . '*');
                if ($permission != "Super") {
                    if ($permission == "admin") {

                        if ($request->is('*users*') || $request->is('*role*') || $request->is('*permission*')) {

                            abort(403, "You don't have permission to this page");
                        }
                    } elseif (!$request->is('*' . $permission . '*')) {

                        abort(403, "You don'nt have permission to this page");
                    }
                }
            }

            return $next($request);
        } else {
            return redirect()->to(route('dashboard'));
        }
    }
}
// Role&permission for user DONE..