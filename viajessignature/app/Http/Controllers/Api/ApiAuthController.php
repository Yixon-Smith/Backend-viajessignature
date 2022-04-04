<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required']
        ]);     

        if ($validator->fails()) {
            return response()->json([
                'status' => 403,
                'message' => $validator->errors()->first(),
            ], 403);
        }
        
        
        if (!$token=Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }


        $user = $request->user();

        $permissions = [];

        if( $request->user()->getAllPermissions() != null ){
           $userPermission = $request->user()->getAllPermissions();
            
            foreach ($userPermission as $permission) {
                $result = explode('.',$permission->name);
                if( count($permissions) != 0 && !in_array($result[0], $permissions) ){
                    array_push($permissions, "/".$result[0]);
                }else if( count($permissions) == 0 ){
                    array_push($permissions, "/".$result[0]);
                }
            }

        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addYears(1);
        }

        $token->save();   
        

        
        return response()->json([
            'status' => 200,
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'routes' => ( count($permissions) != 0 ) ? $permissions : ['*']
        ], 200);
       
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'status' => 200,
            'message' => '¡Cierre de Sessión con Exito!'
        ],200);
    }
}
