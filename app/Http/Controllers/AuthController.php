<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
       $credenciais = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credenciais);
        if ($token){
            return response()->json(['token' => $token]);
        }else{
            return response()->json(['erro' => 'Usuário ou senha inválido!'], 403);

            //erro 401 = Unauthorizad -> não autorizado
            //erro 403 = Forbidden -> proibido (login inválido)
        }
        return 'login';
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Logout realizado com sucesso!']);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }
}
