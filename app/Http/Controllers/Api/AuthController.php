<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);
        $validatedData['role_id'] = 2;
        $validatedData['created_by'] = 1;

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function profile()
    {
        $user_data = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "User data",
            "data" => $user_data
        ]);
    }

    public function logout(Request $request)
    {
        // get token value
        $token = $request->user()->token();

        // revoke this token value
        $token->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
    public function identifyUser(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'enterprise_id' => 'required',

        ]);

        if($validator->fails())
            return (new BaseController)->sendError('Validation Error.', $validator->errors());

        $customerId = $request->customer_id;
        $enterpriseId = $request->enterprise_id;
        $user = User::whereCustomerId($customerId)->whereEnterpriseId($enterpriseId)->first();
        
        //save user dump data
        if (!$user){
            $user = User::create([
                'customer_id' => $customerId,
                'enterprise_id' => $enterpriseId,
                'name'          => 'Customer '. $customerId,
                'email'          => 'Customer'. $customerId.'@gmail.com',
                'password'          => 'Customer@123',
                'role_id'          => Role::first()->id,
                'created_by'          => @Auth::id(),
                
            ]);
        }
        return (new BaseController)->sendResponse($user, 'indentifying user successfully');

    }
}
