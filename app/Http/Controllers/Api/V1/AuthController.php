<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    public function login(Request $request) {
        $data = $request->only('name','password');
        try{
            if(!$token = JWTAuth::attempt($data)){
                return response()->json(['error'=>400,'msg'=>'token创建失败']);
            }
        }catch (JWTException $e){
            return ['error'=>400,'msg'=>'token创建失败'];
        }
        return ['error'=>0,'msg'=>$token];
    }

    public function register(Request $request) {
        $data = $request->only('name','email','password');
        $vali = Validator::make($data,[
            'name' =>  'required|max:255|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ],[
            'email.unique' => '该邮箱已被注册',
            'password.min' => '密码最少为6位字符',
        ]);
        if($vali->fails()){
            return response()->json(['error'=>'400','msg'=>$vali->messages()]);
        }
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $token = JWTAuth::fromUser($user);
        return response()->json(['error'=>0,'msg'=>$token]);
    }
}
