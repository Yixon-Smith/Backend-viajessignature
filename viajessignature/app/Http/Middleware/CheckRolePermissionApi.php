<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRolePermissionApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $user = User::find(Auth::user()->usuario_id);

        //Obteniendo el nombre de la ruta que se esta solicitando
        $ruta = $request->route()->getName();
     
        $userRole = $user->getRoleNames()->first();
        if ($userRole != 'administrador') {
            //Obtener los permisos del usuario
            $userPermission = $request->user()->getAllPermissions();

            $permissions = [];
            foreach ($userPermission as $permission) {
                //guardando el nombre de la ruta y permiso
                array_push($permissions, $permission->name);
            }

            //comprobamos si no existe la ruta de solicitud en el arreglo de permisos del usuario
            if( !in_array($ruta, $permissions) ){
                return response()->json([
                    'status' => 403,
                    'message' => '¡Solicitud Denegada! Usted No Esta Autorizado Para Esta Solicitud'
                ], 403);
            }
        }

        return $next($request);
    }
}
