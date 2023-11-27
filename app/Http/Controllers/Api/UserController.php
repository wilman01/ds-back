<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use JWTAuth;
use Jerry\JWT\JWT;
use Spatie\FlareClient\FlareMiddleware\RemoveRequestIp;
use Tymon\JWTAuth\Exceptions\JWTException;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Tymon\JWTAuth\Facades\JWTAuth;

use App\Mail\RegisterMailable;
use Illuminate\Support\Facades\Mail;

use Log;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['api', 'jwt.verify'])->except(['authenticate']);
    }

    public function index(Request $request){

        $user = User::search($request->q, $request->size);

       return UserCollection::make($user);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $userEnable = User::where('email', $request->get('email'))->Enable()->first();

            if (! $userEnable) {
                return response()->json(['error' => 'Usuario no encontrado'], 403);
            }


            //if (! $token = JWTAuth::attempt($credentials)) {
            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }

            $token = auth()->setTTL(7200)->attempt($credentials);
        }
        catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $payload = [
        "data"=>UserResource::make($userEnable),
        "token"=>$token
        ];
      $t = JWT::encode($payload);
      return response()->json(compact('t'));
    }

    public function getAuthenticatedUser()
    {
        try {
          if (!$user = JWTAuth::parseToken()->authenticate()) {
                  return response()->json(['user_not_found'], 404);
          }
        } catch (TokenExpiredException $e) {
                return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
                return response()->json(['token_invalid'], $e->getStatusCode());
        //} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
        } catch (JWTException $e) {
                return response()->json(['token_absent'], $e->getStatusCode());
        }

        return UserResource::make($user);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cedula' => 'required|string|max:10|unique:users',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'=> 'required'
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::create([
            'cedula' => $request->get('cedula'),
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $user->assignRole($request->role);

        //$token = JWTAuth::fromUser($user);

        //return response()->json(compact('user','token'),201);


        $email = new RegisterMailable($request->all());
        Mail::to('rafahel171@gmail.com')->send($email);
        return UserResource::make($user);

    }

    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            'cedula' => 'required|string|max:10|unique:users,cedula,'.$user->id,
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'string|min:6',
            'status' => 'required|numeric',
            'role'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $user->update($request->except('password') + ['password'=>Hash::make($request->get('password'))]);
        $user->syncRoles($request->role);

        return UserResource::make($user);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function destroy(User $user)
    {
        try {
            if ($user == JWTAuth::parseToken()->authenticate()) {
                return response()->json(['ERROR: No puedes eliminar tu propio usuario'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], 404);
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], 404);
            //} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
        } catch (JWTException $e) {
            return response()->json(['token_absent'], 404);
        }
        $user->delete();
        return UserResource::make($user);

    }
}
