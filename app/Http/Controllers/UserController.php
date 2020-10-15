<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public $secretKey = 'asndfi98w3ey rn8273nyr980yefawe89yq07w89__';

    public function addToken(Request $request) {
        $user = User::findOrFail($request->id);
        $user->git_token = Crypt::encryptString($request->git_token);
        $user->save();
        return response()->json('TOKEN SAVED');
    }

    public function showToken($id) {
        $user = User::findOrFail($id);
        $response = array();
        if ($user->git_token != "") {
            $git_token = Crypt::decryptString($user->git_token);
            $response['git_token'] = $git_token;
        }
        return response()->json($response);
    }

}
