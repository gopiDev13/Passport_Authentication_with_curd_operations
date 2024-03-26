<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;



class AuthController extends Controller
{

  
    public function register(RegisterRequest $request){

      $validated_request = $request->validated();

      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);
      
      $token = $user->createToken(config('services.passport.personal_access_client_name'))->accessToken;
    

      return response()->json([
        'status' => 200,
        'message' => "User Created successfully",
        'token' => $token,
       
      ]);

    }

    public function login(LoginRequest $request){


          $validated_request = $request->validated();

          $data = [
            'email' => $request->email,
            'password' => $request->password,
          ];

          if(auth()->attempt($data)){

            $user = auth()->user();
            
            $token_details = $user->createToken(config('services.passport.personal_access_client_name'))->accessToken;

          

            return response()->json([
                'status' => 200,
                'token' => $token_details,
                'token_type' => 'Bearer token',
                'User logged successfully',
                
            ]);


          }
          return response()->json([
            'message' => 'Invalid crendtials',
          ]);

    }

}
